<?php

namespace App\Http\Controllers\Admin;

use App\Models\FooterAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlertRequest;
use App\Repositories\User\UserInterface;
use Yajra\DataTables\Facades\DataTables;

class FooterAlertController extends Controller
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
            $query = FooterAlert::query();
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
                ->editColumn('published_date', function ($row) {
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
                    if ($status === 'Withdrawn') {
                        if ($this->editAccessEnabled) {
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Withdrawn</a>';
                        }
                    }

                    // If suspended -> offer publish and remove
                    if ($status === 'Suspended') {
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
                ->rawColumns(['action','status','alert_type'])
                ->make(true);
        }
        return view('admin.publications.footer_alert.index');
    }

    public function updateStatus(Request $request, $id)
    {

        try {
            $notification = EscortNotification::findOrFail($id);
            $status = $request->input('status');
            $allowedStatuses = ['Published', 'Suspended', 'Removed'];

            if (!in_array($status, $allowedStatuses)) {
                return error_response('Invalid status', 422);
            }

            if ($status === 'Removed') {
                $notification->delete();
                return success_response(
                    ['id' => $notification->id, 'status' => 'Removed'],
                    'Notification deleted successfully.'
                );
            }

            $notification->update(['status' => $status]);
            return success_response(
                ['id' => $notification->id, 'status' => $status],
                'Status updated successfully.'
            );
        } catch (\Exception $e) {
            return error_response('Failed to update status: ' . $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $n = FooterAlert::findOrFail($id);
            return success_response([
                'id' => $n->id,
                'ref' => sprintf('#%05d', $n->id),
                'heading' => $n->heading,
                'start_date' => basicDateFormat($n->start_date),
                'end_date' => basicDateFormat($n->end_date),
                'type' => $n->type,
                'status' => $n->status,
                'content' => $n->content,
                'template_name' => $n->template_name,
                'member_id' => $n->member_id,
            ]);
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }

    public function store(StoreAlertRequest $request)
    {
        $data =  $request->only(['alert_type', 'subject', 'description', 'message']);
        $alertId = $request->edit_alert_id;

        if ($alertId) {
            $update = FooterAlert::find($alertId);
            $update->alert_type = $request->alert_type;
            $update->subject = $data['subject'];
            $update->description = $request->description;
            $update->message = $request->message;
            $update->save();
            return success_response($data, 'Alert update successfully!!');
        }
        try {
            FooterAlert::create($data);
            return success_response($data, 'Alert create successfully!!');
        } catch (\Exception $e) {
            return error_response('Failed to create alert: ' . $e->getMessage(), 500);
        }
    }

    public function pdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
            $data = FooterAlert::find($decodedId);
            if (is_null($data)) {
                abort(404); // Throws a NotFoundHttpException
            }
            $pdfDetail['ref'] = $data['id'];
            $pdfDetail['heading'] = $data['heading'];
            $pdfDetail['type'] = $data['type'];
            $pdfDetail['status'] = $data['status'];
            $pdfDetail['member_id'] = $data['member_id'];
            $pdfDetail['start_date'] = basicDateFormat($data['start_date']);
            $pdfDetail['end_date'] = basicDateFormat($data['end_date']);
            if ($data['type'] == 'Template') {
                $pdfDetail['template_name'] = $data['template_name'];
            } else {
                $pdfDetail['content'] = $data['content'];
            }


            return view('admin.notifications.escorts.center-notification-pdf-download', compact('pdfDetail'));
        } catch (\Throwable $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $notification = FooterAlert::findOrFail($id);
            $notification->start_date = basicDateFormat($notification->start_date);
            $notification->end_date = basicDateFormat($notification->end_date);
            // Return raw date format for edit form
            $notificationData = $notification->toArray();
            return success_response($notificationData, 'Notification view');
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }

}
