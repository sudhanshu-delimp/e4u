<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConciergePaymentReconciliation;
use App\Models\ProductOrder;
use App\Models\ProductOrderItem;
use App\Models\Supplier;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

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
            ? Carbon::parse($row->bill_generated_date)->format('d-m-Y')
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

          return Carbon::parse($row->bill_start_date)->format('d-m-Y')
            . ' - ' .
            Carbon::parse($row->bill_end_date)->format('d-m-Y');
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

          return '<div class="num_value">$<span>' . number_format((float) ($row->gross_sale_amount ?? 0), 2) . '</span></div>';
        })

        /*
        |--------------------------------------------------------------------------
        | Supplier Amount
        |--------------------------------------------------------------------------
        */
        ->addColumn('supplier_amount', function ($row) {

          return '<div class="num_value">$<span>' . number_format((float) ($row->supplier_amount ?? 0), 2) . '</span></div>';
        })

        /*
        |--------------------------------------------------------------------------
        | E4U Earning
        |--------------------------------------------------------------------------
        */
        ->addColumn('e4u_earning', function ($row) {
          return '<div class="num_value">$<span>' . number_format((float) ($row->e4u_earning ?? 0), 2) . '</span></div>';
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

          $isReconciled = $row->status === 'reconciled';

          $configKey = match ($row->service) {
            'product' => 'app.product_supplier_email',
            'sim'     => 'app.sim_supplier_email',
            'email'   => 'app.email_supplier_email',
            'visa'    => 'app.visa_supplier_email',
            default   => null,
          };

          if ($configKey) {
            $supplier = User::with('supplierBankDetails')
              ->where('type', "10")
              ->where('email', config($configKey))
              ->first();
          }

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

                <a class="dropdown-item align-item-custom report-action"
                   href="#"
                    data-type="approve"
                   data-id="' . $row->id . '">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    Approve
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item align-item-custom  ' . ($isReconciled ? 'report-action' : 'disabled') . '"
                   href="' . ($isReconciled ? '#' : 'javascript:void(0);') . '"
                   data-id="' . $row->id . '"
                   data-type="view"
                    >

                    <i class="fa fa-eye" aria-hidden="true"></i>
                    View Report
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item align-item-custom   ' . ($isReconciled ? 'send-supplier-pdf' : 'disabled') . '"
                   href="#"
                   data-id="' . $row->id . '">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    Email
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item align-item-custom view-supplier" ' .
            'href="#" ' .
            'data-supplier="' . htmlspecialchars(json_encode($supplier, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') . '">' .
            '                    <i class="fa fa-eye" aria-hidden="true"></i>
 View Supplier</a>

            </div>
        </div>
    ';
        })

        ->rawColumns([
          'action',
          'e4u_earning',
          'supplier_amount',
          'gross_sale_amount'
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



  public function getReport(Request $request, $type = "")
  {

    try {

      $period = ConciergePaymentReconciliation::findOrFail($request->id);
      $orderIds = [];
      $startDate = Carbon::createFromFormat('d-m-Y', $period->bill_start_date)->format('Y-m-d');
      $endDate = Carbon::createFromFormat('d-m-Y',  $period->bill_end_date)->format('Y-m-d');

      if ($period && $period->service) {
        $configKey = match ($period->service) {
          'product' => 'app.product_supplier_email',
          'sim'     => 'app.sim_supplier_email',
          'email'   => 'app.email_supplier_email',
          'visa'    => 'app.visa_supplier_email',
          default   => null,
        };

        if ($configKey) {
          $supplier = User::with('supplierBankDetails')
            ->where('type', "10")
            ->where('email', config($configKey))
            ->first();
        }
      }

      $orderIds = ProductOrder::whereDate('order_date', '>=', $startDate)->whereDate('order_date', '<=', $endDate)->pluck('id')->toArray();
      // $items = ProductOrderItem::with('productOrder', 'productOrder.user', 'product')->whereIn('order_id', $orderIds)->get();
      $items = ProductOrderItem::with([
        'productOrder.user.state', // Prevents N+1 query inside Blade
        'product'
      ])
        ->whereHas('productOrder', function ($q) use ($startDate, $endDate) {
          $q->whereBetween('order_date', [$startDate, $endDate]);
        })
        ->get();
      $type = $request->type ?? "";
      $report_id = $request->id;
      $title = Str::ucfirst($period->service);
      $periodTitle = "Payments Report {$title} - " . ($supplier->name ?? '') . " (Period Ending " . date('d-m-Y', strtotime($endDate)) . ")";
      if ($type == "pdf") {

        $pdf = Pdf::loadView('admin.Concierge.conserge_report', compact('items', 'report_id', 'supplier', 'type', 'periodTitle'));
        return $pdf->stream('report-' . $report_id . '.pdf');
      } else if ($type == "send") {


        $pdf = Pdf::loadView('admin.Concierge.conserge_report', compact('items', 'report_id', 'supplier', 'type', 'periodTitle'));
        // 2. Send email with attached PDF
        Mail::send('emails.supplier.supplier-report', ['supplier' => $supplier], function ($message) use ($supplier, $pdf) {
          $message->to("ashish.kumar+34@delimp.com")
            ->subject('Supplier Report Summary')
            ->attachData($pdf->output(), "supplier_report_{$supplier->id}.pdf", [
              'mime' => 'application/pdf',
            ]);
        });

        return response()->json([
          'status' => 'success',
          'message' => 'PDF report successfully sent to ' . $supplier->email
        ]);
      }


      $html = view('admin.Concierge.conserge_report', compact('items', 'report_id', 'supplier', 'type', 'periodTitle'))->render();

      return response()->json([
        'status' => true,
        'html' => $html,
        'period' => $period
      ]);
    } catch (Exception $e) {
      Log::info($e->getMessage());
    }
  }


  public function approveReport(Request $request)
  {
    $report = ConciergePaymentReconciliation::find($request->id);
    if (!$report) {
      return response()->json([
        'status' => false,
        'message' => 'Report not found.'
      ]);
    }

    if ($report->status === 'reconciled') {
      return response()->json([
        'status' => false,
        'message' => 'This report is already reconciled.'
      ]);
    }

    $report->status = 'reconciled';
    $report->save();

    return response()->json([
      'status' => true,
      'message' => 'Report reconciled successfully.'
    ]);
  }
  public function supplierDetails(Request $request)
  {
    $supplier = User::find($request->id);

    if (!$supplier) {
      return response()->json([
        'status' => false,
        'message' => 'supplier not found.'
      ]);
    }



    return response()->json([
      'status' => true,
      'data' => $supplier,
    ]);
  }

  // public function supplierReportEmail(Request $request)
  // {
  //   $request->validate(['id' => 'required|exists:concierge_payment_reconciliation,id']);
  //   try {

  //     $period = ConciergePaymentReconciliation::findOrFail($request->id);
  //     $orderIds = [];
  //     $startDate = Carbon::createFromFormat('d-m-Y', $period->bill_start_date)->format('Y-m-d');
  //     $endDate = Carbon::createFromFormat('d-m-Y',  $period->bill_end_date)->format('Y-m-d');

  //     if ($period && $period->service) {
  //       $configKey = match ($period->service) {
  //         'product' => 'app.product_supplier_email',
  //         'sim'     => 'app.sim_supplier_email',
  //         'email'   => 'app.email_supplier_email',
  //         'visa'    => 'app.visa_supplier_email',
  //         default   => null,
  //       };

  //       if ($configKey) {
  //         $supplier = User::with('supplierBankDetails')
  //           ->where('type', "10")
  //           ->where('email', config($configKey))
  //           ->first();
  //       }
  //     }

  //     $orderIds = ProductOrder::whereDate('order_date', '>=', $startDate)->whereDate('order_date', '<=', $endDate)->pluck('id')->toArray();
  //     $items = ProductOrderItem::with('productOrder', 'productOrder.user', 'product')->whereIn('order_id', $orderIds)->get();
  //     $report_id = $request->id;
  //     // 1. Generate PDF from view
  //           $period = "Payments Report Product - $supplier->name (Period Ending " . date('d-m-Y', strtotime($endDate)) . ")";

  //     $pdf = Pdf::loadView('admin.Concierge.conserge_report', compact('items', 'report_id', 'supplier'));
  //     // 2. Send email with attached PDF
  //     Mail::send('emails.supplier.supplier-report', ['supplier' => $supplier], function ($message) use ($supplier, $pdf) {
  //       $message->to("ashish.kumar+34@delimp.com")
  //         ->subject('Supplier Report Summary')
  //         ->attachData($pdf->output(), "supplier_report_{$supplier->id}.pdf", [
  //           'mime' => 'application/pdf',
  //         ]);
  //     });

  //     return response()->json([
  //       'status' => 'success',
  //       'message' => 'PDF report successfully sent to ' . $supplier->email
  //     ]);
  //   } catch (\Exception $e) {
  //     return response()->json([
  //       'status' => 'error',
  //       'message' => 'Email failed: ' . $e->getMessage()
  //     ], 500);
  //   }
  // }
}
