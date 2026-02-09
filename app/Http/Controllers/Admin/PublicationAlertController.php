<?php

namespace App\Http\Controllers\Admin;

use App\Models\AlertNotic;
use Illuminate\Http\Request;
use App\Models\PublicationAlert;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlertRequest;
use App\Repositories\User\UserInterface;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\Translation\t;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;


class PublicationAlertController extends Controller
{
    protected $viewAccessEnabled;
    protected $editAccessEnabled;
    protected $addAccessEnabled;
    protected $sidebar;
    protected $user;
    protected $current_date_time;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
        $this->current_date_time = date('Y-m-d H:i:s');
        $this->middleware(function ($request, $next) {
            $user = auth()->user();   // works here

            // Now do everything that needs user data
            $securityLevel = isset($user->staff_detail->security_level) ? $user->staff_detail->security_level : 0;

            $viewAccess = staffPageAccessPermission($securityLevel, 'view');
            $editAccess = staffPageAccessPermission($securityLevel, 'edit');
            $addAccess = staffPageAccessPermission($securityLevel, 'add');

            $this->viewAccessEnabled  = isset($viewAccess['yesNo']) && $viewAccess['yesNo'] == 'yes';
            $this->editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
            $this->addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = PublicationAlert::query();
            $clientOrder = $request->input('order');
            if (empty($clientOrder)) {
                $query->orderBy('created_at', 'DESC');
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('ref', function ($row) {
                    return sprintf('#%05d', $row->id);
                })
                ->filterColumn('ref', function ($query, $keyword) {
                    $digits = ltrim($keyword, '#0');
                    if ($digits !== '') {
                        $query->where('id', 'like', "%{$digits}%");
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return basicDateFormat($row['created_at']);
                })

                ->editColumn('alert_type', function ($row) {
                    return $row->alert_type;
                })
                ->orderColumn('alert_type', function ($query, $order) {
                    $query->orderBy('alert_type', $order);
                })

                ->orderColumn('status', function ($query, $order) {
                    $query->orderBy('status', $order);
                })
                ->addColumn('action', function ($row) {
                    $actions = [];
                    $status = $row->status ?? null;
                    if ($this->editAccessEnabled) {
                        $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-edit" data-id="' . $row->id . '"><i class="fa fa-fw fa-edit"></i> Edit</a>';
                    }

                    // If published -> offer suspend
                    if ($status === 'Published') {
                        if ($this->editAccessEnabled) {
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-withdrawn" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Withdraw</a>';
                        }
                    }

                    // If suspended -> offer publish and remove
                    if ($status === 'Withdrawn') {
                        if ($this->editAccessEnabled) {
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-publish" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Publish</a>';
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Remove</a>';
                        }
                    }

                    // Common actions
                    $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-view" data-id="' . $row->id . '"><i class="fa fa-eye"></i> View</a>';


                    $dropdown = '<div class="dropdown no-arrow">'
                        . '<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                        . '<i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>'
                        . '</a>'
                        . '<div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">'
                        . implode('<div class="dropdown-divider"></div>', $actions)
                        . '</div>'
                        . '</div>';

                    return $dropdown;
                })
                ->rawColumns(['action', 'status', 'alert_type', 'ref', 'created_at'])
                ->make(true);
        }
        return view('admin.publications.footer_alert.index');
    }

    public function updateStatus(Request $request, $id)
    {

        try {
            $alert = PublicationAlert::findOrFail($id);
            $status = $request->input('status');
            $allowedStatuses = ['Published', 'Withdrawn', 'Removed'];

            if (!in_array($status, $allowedStatuses)) {
                return error_response('Invalid status', 422);
            }

            if ($status === 'Removed') {
                $alert->delete();
                return success_response(
                    ['id' => $alert->id, 'status' => 'Removed'],
                    'Alert deleted successfully.'
                );
            }

            $alert->update(['status' => $status]);
            return success_response(
                ['id' => $alert->id, 'status' => $status],
                'Status updated successfully.'
            );
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $n = PublicationAlert::findOrFail($id);
            return success_response([
                'id' => $n->id,
                'ref' => sprintf('#%05d', $n->id),
                'alert_type' => $n->alert_type,
                'subject' => $n->subject,
                'description' => $n->description,
                'message' => $n->message,
                'status' => $n->status,
                'create_date' => basicDateFormat($n->created_at)
            ]);
        } catch (\Exception $e) {
            return error_response('Failed to fetch alert: ' . $e->getMessage(), 500);
        }
    }

    public function store(StoreAlertRequest $request)
    {
        $data =  $request->only(['alert_type', 'subject', 'description', 'message']);
        $alertId = $request->edit_alert_id;

        if ($alertId) {
            $update = PublicationAlert::find($alertId);
            $update->alert_type = $request->alert_type;
            $update->subject = $data['subject'];
            $update->description = $request->description;
            $update->message = $request->message;
            $update->save();
            return success_response($data, 'Alert update successfully!!');
        }
        try {
            PublicationAlert::create($data);
            return success_response($data, 'Alert create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create alert: ' . $e->getMessage(), 500);
        }
    }

    public function edit($id)
    {
        try {
            $editAlert = PublicationAlert::findOrFail($id);
            // Return raw date format for edit form
            $editAlert['create_date'] = basicDateFormat($editAlert->created_at);
            $editAlert = $editAlert->toArray();
            return success_response($editAlert, 'Alert view');
        } catch (\Exception $e) {
            return error_response('Failed to fetch alert: ' . $e->getMessage(), 500);
        }
    }

    public function noticeStore(Request $request)
    {

        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'motion' => 'required|string',
                    //'notice_descrioption' => 'required|string'
                ],
                [
                    'motion.required' => '',
                    'motion.string' => '',

                    //'notice_descrioption.required' => 'Description is required.',
                    //'notice_descrioption.string' => 'Description must be text.',
                ]
            );

            if ($validator->fails()) {
                $errors = [];
                foreach ($validator->errors()->messages() as $field => $messages) {
                    $errors[$field] = $messages[0]; // first error only
                }
                return error_response('Validation failed', 422, $errors);
            }
        } catch (ValidationException $e) {
            return error_response($e->errors(), 422);
        }

        $data = $request->only(['id', 'motion', 'notice_descrioption', 'action']);
        try {
            AlertNotic::updateOrCreate(['id' => 1],
            $data);
            return success_response($data, 'Notice create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create notice: ' . $e->getMessage(), 500);
        }
    }

    //show Alert 
    public function noticeShow(){
        try{
        $data = AlertNotic::first();
        return success_response($data, 'Notice create successfully!!');
        } catch(\Exception $e){
            return error_response('Failed to create notice: ' . $e->getMessage(), 500);
        }
    }
}
