<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConciergePaymentReconciliation;
use App\Models\ProductOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ConciergeReportController extends Controller
{
  protected $viewAccessEnabled;
  protected $editAccessEnabled;
  protected $addAccessEnabled;
  protected $sidebar;

  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      $user = auth()->user();   // works here
      // Now do everything that needs user data
      $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

      $viewAccess = staffPageAccessPermission($securityLevel, 'view');
      $editAccess = staffPageAccessPermission($securityLevel, 'edit');
      $addAccess = staffPageAccessPermission($securityLevel, 'add');
      $this->sidebar = staffPageAccessPermission($securityLevel, 'sidebar');

      $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
      $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
      $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';
      return $next($request);
    });
  }
  public function index(Request $request)
  {

    if ($request->ajax()) {

      $query = ConciergePaymentReconciliation::query();

      /*
    |--------------------------------------------------------------------------
    | Billing Period Filter
    |--------------------------------------------------------------------------
    | Example:
    | billing_period = 2026-09
    |--------------------------------------------------------------------------
    */
      if ($request->filled('billing_period')) {

        try {

          $date = Carbon::createFromFormat(
            'Y-m',
            $request->billing_period
          );

          $startDate = $date->copy()->startOfMonth()->format('Y-m-d');
          $endDate   = $date->copy()->endOfMonth()->format('Y-m-d');

          $query->where(function ($q) use ($startDate, $endDate) {

            $q->whereDate('bill_start_date', '<=', $endDate)
              ->whereDate('bill_end_date', '>=', $startDate);
          });
        } catch (\Exception $e) {

          // Invalid billing period - don't apply filter
        }
      }

      return DataTables::of($query)

        /*
        |--------------------------------------------------------------------------
        | Bill Generated Date
        |--------------------------------------------------------------------------
        */
        ->addColumn('bill_generated_date', function ($row) {

          return $row->bill_generated_date
            ? Carbon::parse($row->bill_generated_date)->format('Y-m-d')
            : 'NA';
        })

        /*
        |--------------------------------------------------------------------------
        | Billing Period
        |--------------------------------------------------------------------------
        */
        ->addColumn('billing_period', function ($row) {

          if (!$row->bill_start_date || !$row->bill_end_date) {
            return 'NA';
          }

          return Carbon::parse($row->bill_start_date)->format('M d, Y')
            . ' - ' .
            Carbon::parse($row->bill_end_date)->format('M d, Y');
        })

        /*
        |--------------------------------------------------------------------------
        | Service
        |--------------------------------------------------------------------------
        */
        ->addColumn('service', function ($row) {

          return $row->service
            ? ucwords(str_replace('_', ' ', $row->service))
            : 'NA';
        })

        /*
        |--------------------------------------------------------------------------
        | Gross Sale Amount
        |--------------------------------------------------------------------------
        */
        ->addColumn('gross_sale_amount', function ($row) {

          return number_format(
            (float) ($row->gross_sale_amount ?? 0),
            2
          );
        })

        /*
        |--------------------------------------------------------------------------
        | Supplier Amount
        |--------------------------------------------------------------------------
        */
        ->addColumn('supplier_amount', function ($row) {

          return number_format(
            (float) ($row->supplier_amount ?? 0),
            2
          );
        })

        /*
        |--------------------------------------------------------------------------
        | E4U Earning
        |--------------------------------------------------------------------------
        */
        ->addColumn('e4u_earning', function ($row) {

          return number_format(
            (float) ($row->e4u_earning ?? 0),
            2
          );
        })

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */
        ->addColumn('status', function ($row) {

          return $row->status
            ? ucwords(str_replace('_', ' ', $row->status))
            : 'NA';
        })

        /*
        |--------------------------------------------------------------------------
        | Action
        |--------------------------------------------------------------------------
        */
        ->addColumn('action', function ($row) {

          return '
                <div class="dropdown no-arrow">

                    <a class="dropdown-toggle"
                       href="#"
                       role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">

                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>

                    </a>

                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">

                        <a class="dropdown-item align-item-custom"
                           href="#"
                           data-id="' . $row->id . '"
                           data-toggle="modal"
                           data-target="#viewReports">

                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            Approve

                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item align-item-custom"
                           href="#"
                           data-id="' . $row->id . '"
                           data-toggle="modal"
                           data-target="#viewReports">

                            <i class="fa fa-eye" aria-hidden="true"></i>
                            View Report

                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item align-item-custom"
                           href="#"
                           data-id="' . $row->id . '">

                            <i class="fa fa-at" aria-hidden="true"></i>
                            Email

                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item align-item-custom"
                           href="#"
                           data-id="' . $row->id . '"
                           data-toggle="modal"
                           data-target="#viewReports">

                            <i class="fa fa-eye" aria-hidden="true"></i>
                            View Supplier

                        </a>

                    </div>
                </div>
            ';
        })

        ->rawColumns([
          'action'
        ])

        ->make(true);
    }

    /*
    |--------------------------------------------------------------------------
    | DataTable Columns
    |--------------------------------------------------------------------------
    */

    $columns = [
      [
        'data' => 'bill_generated_date',
        'name' => 'bill_generated_date',
        'searchable' => true,
        'orderable' => true,
        'defaultContent' => 'NA',
      ],
      [
        'data' => 'billing_period',
        'name' => 'billing_period',
        'searchable' => true,
        'orderable' => false,
        'defaultContent' => 'NA',
      ],
      [
        'data' => 'service',
        'name' => 'service',
        'searchable' => true,
        'orderable' => true,
        'defaultContent' => 'NA',
      ],
      [
        'data' => 'gross_sale_amount',
        'name' => 'gross_sale_amount',
        'searchable' => true,
        'orderable' => true,
        'defaultContent' => '0.00',
      ],
      [
        'data' => 'supplier_amount',
        'name' => 'supplier_amount',
        'searchable' => true,
        'orderable' => true,
        'defaultContent' => '0.00',
      ],
      [
        'data' => 'e4u_earning',
        'name' => 'e4u_earning',
        'searchable' => true,
        'orderable' => true,
        'defaultContent' => '0.00',
      ],
      [
        'data' => 'status',
        'name' => 'status',
        'searchable' => true,
        'orderable' => true,
        'defaultContent' => 'NA',
      ],
      [
        'data' => 'action',
        'name' => 'action',
        'searchable' => false,
        'orderable' => false,
        'defaultContent' => 'NA',
        'className' => 'text-center',
      ],
    ];

    return view(
      'admin.Concierge.payment-reconciliation',
      compact('columns')
    );
  }
}
