<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaVerification;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class MediaVerificationController extends Controller
{
    public function index()
    {
        return view('admin.reports.media-verification.index');
    }

    public function mediaVerificationLList()
    {
        list($result, $count) = $this->getMediaVerificationData(
            request()->get('start'),
            request()->get('length'),
            (request()->get('order')[0]['column']),
            request()->get('order')[0]['dir']
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result
        );

        return response()->json($data);
    }

    public function getMediaVerificationData($start, $limit, $order_key, $dir)
    {

        $media_verificatiion = MediaVerification::with('user.my_agent');
        $search = request()->input('search.value', '');
        $search = is_string($search) ? trim($search) : '';
        // Check if search input looks like a phone number (contains only digits and spaces)
        if (preg_match('/^[0-9\s]+$/', $search)) {
            // Remove spaces only for phone number search
            $search = str_replace(' ', '', $search);
        }

        if ($search) {
            $media_verificatiion->where(function($q) use ($search) {
                $q->whereHas('user', function($q2) use ($search) {
                    $q2->where('member_id', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
                });
            });
        }

        if ($order_key === null) {
            $media_verificatiion->orderByRaw("FIELD(media_verifications.status,'0','1','2')")
                ->orderBy('media_verifications.created_at', 'desc');
        }

        switch ($order_key) {

            case 0: // member_id (users.member_id)
                $media_verificatiion->orderBy(
                    User::select('member_id')
                        ->whereColumn('users.id', 'media_verifications.user_id'),
                    $dir
                );
                break;

            case 2: // name (users.name)
                $media_verificatiion->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'media_verifications.user_id'),
                    $dir
                );
                break;

            case 3: // mobile (users.mobile)
                $media_verificatiion->orderBy(
                    User::select('phone')
                        ->whereColumn('users.id', 'media_verifications.user_id'),
                    $dir
                );
                break;

            case 5: // agent_id (users.assigned_agent_id)
                $media_verificatiion->orderBy(
                    User::select('assigned_agent_id')
                        ->whereColumn('users.id', 'media_verifications.user_id'),
                    $dir
                );
                break;
        }


        $total_media_verificatiion = $media_verificatiion->count();
        $media_verificatiions = $media_verificatiion->offset($start)->limit($limit)->get();

        foreach ($media_verificatiions as $key => $item) {

            $item->member_id = $item->user->member_id ?? 'N/A';

            $item->created_date = isset($item->created_at)
                ? showDateWithFormat($item->created_at)
                : 'NA';

            $item->name = $item->user->name ?? 'N/A';

            $item->mobile = $item->user->phone ?? 'N/A';

            $item->submitted = getTypeById($item->user->type) ? getTypeById($item->user->type) : '<N>A';
            $item->agent_id = $item->user->my_agent->member_id ?? 'N/A';
            $types = [
                '0' => 'Selfie',
                '1' => 'Licence',
                '2' => 'Passport'
            ];

            $item->type = $types[$item->type] ?? 'N/A';
            $status = $item->raw_status;

            $approve_html = '';
            $reject_html = '';
            $view_tag = '';
            $view_centre = '';

            if ($status == 0) {
                $approve_html = '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 approve-btn"
                        href="javascript:void(0)" data-id="' . $item->id . '">
                        <i class="fa fa-check-circle"></i> Approve
                    </a>
                    <div class="dropdown-divider"></div>';

                $reject_html = '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 reject-btn"
                        href="javascript:void(0)" data-id="' . $item->id . '">
                        <i class="fa fa-ban"></i> Reject
                    </a>
                    <div class="dropdown-divider"></div>';
            }

            $view_image = '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-image-btn"
                href="javascript:void(0)" data-toggle="modal" data-target="#view_image" data-id="' . $item->id . '">
                <i class="fa fa-eye"></i> View Image
            </a>
            ';

            if ($item->user->type == '4') {
                $view_tag = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-tag-btn"
                    href="javascript:void(0)" data-toggle="modal" data-target="#view_tag" data-id="' . $item->id . '">
                    <i class="fa fa-eye"></i> View Tag
                </a>
                <div class="dropdown-divider"></div>';

                $view_centre = '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-centre-btn"
                    href="javascript:void(0)" data-toggle="modal" data-target="#view-centre" data-id="' . $item->id . '">
                    <i class="fa fa-eye"></i> View Centre
                </a>';
            }

            $dropdown = '<div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">
                    ' . $approve_html . $reject_html . $view_image . $view_tag . $view_centre . '
                </div>
            </div>';

            $statusText = $item->status ?? 'NA';
            $badgeClass = getStatusBadgeClass($statusText);
            $item->status_text = "<span class='custom_badge {$badgeClass}'>{$statusText}</span>";
            $item->action = $dropdown;
        }
        return [$media_verificatiions, $total_media_verificatiion];
    }
}
