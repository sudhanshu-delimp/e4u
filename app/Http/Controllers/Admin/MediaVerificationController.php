<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MediaVerificationAdvertiserMail;
use App\Models\EscortMedia;
use App\Models\MassageMedia;
use App\Models\MediaVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mail;

class MediaVerificationController extends Controller
{
    public function index()
    {
        return view('admin.reports.media-verification.index');
    }

    public function mediaVerificationLList()
    {
        $order = request()->get('order');
        $column = null;
        $dir = 'asc';

        if (!empty($order)) {
            $column = $order[0]['column'] ?? null;
            $dir = $order[0]['dir'] ?? 'asc';
        }

        list($result, $count, $total_pending_verification) = $this->getMediaVerificationData(
            request()->get('start'),
            request()->get('length'),
            $column,
            $dir
        );
        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $result,
            "totalPending"    => intval($total_pending_verification)
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
            $media_verificatiion->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('member_id', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
            });
        }

        if (!request()->has('order')) {
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
        }


        $total_media_verificatiion = $media_verificatiion->count();
        $media_verificatiions = $media_verificatiion->offset($start)->limit($limit)->get();

        $total_pending_verification =  0;
        foreach ($media_verificatiions as $key => $item) {
            $user = $item->user;
            $item->member_id = $user->member_id ?? 'N/A';
            $item->name      = $user->name ?? 'N/A';
            $item->mobile    = $user->phone ?? 'N/A';
            $item->created_date = $item->created_at
                ? showDateWithFormat($item->created_at)
                : 'NA';
            $submittedUser = User::select('type', 'member_id')->find($item->submited_by);

            $item->submitted = $submittedUser
                ? (getUserTypeById($submittedUser->type) === 'Massage-Center' ? 'Centre' : getUserTypeById($submittedUser->type))
                : 'N/A';

            $item->agent_id = ($item->submitted === 'Agents')
                ? $submittedUser->member_id ?? 'N/A'
                : 'N/A';

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
                        href="javascript:void(0)" " data-user_type="' . $user->type . '" data-id="' . $item->id . '">
                        <i class="fa fa-check-circle"></i> Approve
                    </a>
                    <div class="dropdown-divider"></div>';

                $reject_html = '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 reject-btn"
                        href="javascript:void(0)" " data-user_type="' . $user->type . '" data-id="' . $item->id . '">
                        <i class="fa fa-ban"></i> Reject
                    </a>
                    <div class="dropdown-divider"></div>';
            }

            $view_image = '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-image-btn"
                href="javascript:void(0)" data-toggle="modal" data-target="#view_image" data-status="' . $item->status . '" data-id="' . $item->id . '" data-user_type="' . $user->type . '" data-member-id="' . $item->member_id . '" data-user-id="' . $item->user->id . '">
                <i class="fa fa-eye"></i> View Image
            </a>
            ';

            // if ($item->user->type == '4') {
            //     $view_tag = '<div class="dropdown-divider"></div><a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-tag-btn"
            //         href="javascript:void(0)" data-toggle="modal" data-target="#view_tag" data-id="' . $item->id . '">
            //         <i class="fa fa-eye"></i> View Tag
            //     </a>
            //     <div class="dropdown-divider"></div>';

            //     $view_centre = '<a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view-centre-btn"
            //         href="javascript:void(0)" data-toggle="modal" data-target="#view-centre" data-id="' . $item->id . '">
            //         <i class="fa fa-eye"></i> View Centre
            //     </a>';
            // }

            $dropdown = '<div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">
                    ' . $approve_html . $reject_html . $view_image . $view_tag . $view_centre . '
                </div>
            </div>';

            if ($item->status == 'Pending') {
                $total_pending_verification++;
            }
            $statusText = $item->status ?? 'NA';
            $badgeClass = getStatusBadgeClass($statusText);
            $tooltipHtml = '';

            if (in_array($statusText, ['Verified', 'Rejected'])) {
                $staffId = get_massage_member_id($item->reviewed_by);
                $actionText = $statusText === 'Rejected' ? 'Rejected by' : 'Approved by';
                $tooltipHtml = "<span class='tooltip'>{$actionText}: {$staffId}</span>";
            }

            $item->status_text = "<div class='e4u-tooltip'>
                <span class='custom_badge {$badgeClass}'>{$statusText}</span>
                {$tooltipHtml}
            </div>";
            $item->action = $dropdown;
        }
        return [$media_verificatiions, $total_media_verificatiion, $total_pending_verification];
    }



    public function mediaVerificationImage(Request $request)
    {
        $id = $request->get('id');
        $user_id = $request->get('user_id');
        $category =  $request->get('type');
        if($category == "banners"){
            $category = '9';
        }else if($category == "pinups"){
                $category = '10';
        }else{
            $category = 'gallery';
        }

        $media_verification = MediaVerification::where('id', $id)
            ->where('user_id', $user_id)
            ->first();
        $status = $media_verification->getRawOriginal('status');
        $user = User::findOrFail($user_id);
     
        if($user->type == 3){
            $query = EscortMedia::where('user_id', $user_id)->where('type', '0');
        }else{
           $query = MassageMedia::where('user_id', $user_id)->where('type', '0'); 
        }        
        
        if ($category == 9) {
            $query->where('position', 9);
            $query->where('template', '0');
        } elseif ($category == 10) {
            $query->where('position', 10);

        } else {
            // Gallery → NOT 9,10 + NULL include
            $query->where(function ($q) {
                $q->whereNotIn('position', [9, 10])
                ->orWhereNull('position');
            });
        }
        switch ($status) {
            case '1': // Approved
                $query->where('media_verification_id', $id)
                    ->where('varified', '1');
                break;

            case '2': // Rejected
                $query->where('media_verification_id', $id)
                    ->where('varified', '2');
                break;

            case '0': // Pending
            default:
                $query->whereNull('media_verification_id')
                    ->where('varified', '0');
                break;
        }

        $escort_medias = $query->get();
        $media_verification_image = asset('escorts/' . $media_verification->image_path);
        $bannerImage = [];
        $pinupImage =  [];
        $mediaImages = [];
        foreach ($escort_medias as $escort_media) {
            if ($escort_media->varified == "0") {
                    $verification_icon = '<img src="'.asset('assets/app/img/pending_icon/e4u_pending-icon_REV.png').'" /><span class="mc_media_tooltip">Media Pending</span>';
                    $uploaded_date ='<div class="upload_date">Uploaded: <span>'.showDateWithFormat($escort_media->created_at).'</span></div>';
                } elseif ($escort_media->varified == "2") {
                    $verification_icon = '<img src="'.asset('assets/app/img/verify/unverified_icon.png').'" /><span class="mc_media_tooltip">Media Unverified</span>';
                    $uploaded_date ='<div class="upload_date">Rejected: <span>'.showDateWithFormat($escort_media->updated_at).'</span></div>';
                } else {
                    $verification_icon = '<img src="'.asset('assets/app/img/verify/verified_icon.png').'" /><span class="mc_media_tooltip">Media Verified</span>';
                    $uploaded_date ='<div class="upload_date">Approved: <span>'.showDateWithFormat($escort_media->updated_at).'</span></div>';
                }
                $position = $escort_media->position ?? 0;
                switch ($position) {
                case 9:
                    $bannerImage[] = '<div class="verify_icon_wrapper">'.$uploaded_date.'<img src="' . asset($escort_media->path) . '" class="banner-img" alt="Banner Image"> <span class="verify_icon">
                                            '.$verification_icon.'</div>';  
                    break;
                case 10:
                    $pinupImage[] = '<div class="verify_icon_wrapper">'.$uploaded_date.'<img src="' . asset($escort_media->path) . '" class="pinup-img" alt="Pinup Image"><span class="verify_icon">
                                            '.$verification_icon.'</div>';
                    break;

                default:
                    $mediaImages[] = '<div class="verify_icon_wrapper">'.$uploaded_date.'<img src="' . asset($escort_media->path) . '" class="gallery-img" alt="Gallery Image"><span class="verify_icon">
                                           '.$verification_icon.'</div>';
                    break;
            }
        }

        if ($media_verification) {
            return response()->json([
                'status' => true,
                'media_verification_image' => $media_verification_image,
                'media_banner_image' => $bannerImage,
                'media_pinup_image' => $pinupImage,
                'media_img' => $mediaImages,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Media verification not found.'
            ], 404);
        }
    }

    public function updateMediaVerification(Request $request)
    {
        $id = $request->get('id');
        $media_verification = MediaVerification::find($id);

        if (!$media_verification) {
            return response()->json([
                'status' => 'error',
                'message' => 'Media verification not found.'
            ], 404);
        }

        $media_verification->status = (string) $request->get('status');

        // $media_verification->status = '0';
        $media_verification->reviewed_by = Auth::id();
        $media_verification->reviewed_at = Carbon::now();
        $media_verification->save();

        $model = $request->user_type == '3' ? EscortMedia::class : MassageMedia::class;
        $model::where('user_id', $media_verification->user_id)
            ->where('varified', '0')
            ->where('type', 0)
            ->whereNull('media_verification_id')
            ->update([
                'media_verification_id' => $media_verification->id,
                'varified' => (string) $request->get('status')
            ]);
        
        $user = User::with('my_agent')
            ->select('id', 'name', 'email', 'member_id', 'assigned_agent_id')
            ->find($media_verification->user_id);

        $body = [
            'name' => $user->name ?? $user->email,
            'email' => $user->email,
            'member_id' => $user->member_id,
            'status' => $request->get('status'),
            'agent_id' => $user->my_agent->member_id ?? null,
        ];

        $ccEmail = $user->my_agent->email ?? null;

        $status = $media_verification->getRawOriginal('status');

        switch ($status) {
            case '1': // Approved
            case '2': // Rejected
                $cc = !empty($ccEmail) ? [$ccEmail] : [];
                Mail::to($body['email'])
                    ->cc($cc)
                    ->queue(new MediaVerificationAdvertiserMail($body));

                break;

            default: // Pending 
                break;
        }
        return response()->json([
            'status' => true,
            'message' => 'Media verification '.strtolower($media_verification->status).' successfully.',
            'media_verification_status' => $status
        ]);
    }


    public function galleryPdf($id , $user_id){
        $media_verification = MediaVerification::where('id', $id)
            ->where('user_id', $user_id)
            ->first();
        $status = $media_verification->getRawOriginal('status');
        $user = User::findOrFail($user_id);
        $user_type = $user->type;
        $model = $user_type == '3'  ? EscortMedia::class : MassageMedia::class;
        $query = $model::where('user_id', $user_id)->where('type', '0');
        $member_id = get_massage_member_id($user_id);

        $media_verification_image = asset('escorts/' . $media_verification->image_path);
        
        switch ($status) {
            case '1': // Approved
                $query->where('media_verification_id', $id)
                    ->where('varified', '1');
                break;

            case '2': // Rejected
                $query->where('media_verification_id', $id)
                    ->where('varified', '2');
                break;

            case '0': // Pending
            default:
                $query->whereNull('media_verification_id')
                    ->where('varified', '0');
                break;
        }

        $escorts_medias = $query->get();
        $bannerImage = [];
        $pinupImage =  [];
        $mediaImages = [];
        foreach ($escorts_medias as $escort_media) { 
            switch ($escort_media->position) {
                case 9:
                    $bannerImage[] = '<img src="' . asset($escort_media->path) . '" style="width:170px; border: 1px solid #ccc; padding:10px; height: 120px; object-fit: cover;" >';
                    break;
                case 10:
                    $pinupImage[] = '<img src="' . asset($escort_media->path) . '" " style="width:170px; border: 1px solid #ccc; padding:10px; height: 120px; object-fit: cover;">';
                    break;

                default:
                    $mediaImages[] = '<img src="' . asset($escort_media->path) . '" " style="width:170px; border: 1px solid #ccc; padding:10px;height: 120px; object-fit: cover;">';
                    break;
            }
        }
        return view('admin.reports.media-verification.gallery-pdf', compact('bannerImage','pinupImage','mediaImages','member_id','media_verification_image','user_type'));
    }
}
