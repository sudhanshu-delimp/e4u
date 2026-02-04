<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ImageService;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePublicationRequest;
use App\Models\PublicationBlog;

class PublicationBlogController extends Controller
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
            $query = PublicationBlog::query()->select('id', 'blog_image', 'title' , 'status', 'created_at');
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
                        $query->where('id', "$digits");
                    }
                })
                
                ->addColumn('image', function ($row) {
                    $imageUrl = ImageService::url($row->blog_image, 'thumb', 'publication_blog');
                    if($imageUrl == null){
                        $imageUrl = asset('assets/dashboard/img/no-image.png');
                    }
                    return "<img src='{$imageUrl}' alt='{$row->image}' class='blog-img-admin theme-color'/>";
                })
                
                ->addColumn('title', function ($row) {
                    return $row->title;
                })

                ->filterColumn('title', function ($query, $keyword) {
                    $query->where('title', 'like', "%{$keyword}%");
                })

                ->addColumn('posted_date', function ($row) {
                    return basicDateFormat($row->created_at);
                })
                ->editColumn('status', function ($row) {
                    return "<spam class='custom_badge badge_published'>{$row->status} </spam>" ;
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
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-suspend" data-id="' . $row->id . '"><i class="fa fa-fw fa-times"></i> Suspend</a>';
                        }
                    }

                    // If suspended -> offer publish and remove
                    if ($status === 'Suspended') {
                        if ($this->editAccessEnabled) {
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-publish" data-id="' . $row->id . '"><i class="fa fa-fw fa-upload"></i> Publish</a>';
                            $actions[] = '<a href="#" class="dropdown-item d-flex align-items-center justify-content-start gap-10 js-remove" data-id="' . $row->id . '"><i class="fa fa-trash"></i> Remove</a>';
                        }
                    }

                    // If completed -> offer remove
                    if ($status === 'Completed') {
                        if ($this->editAccessEnabled) {
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
                ->rawColumns(['action', 'posted_date', 'status', 'image', 'title'])
                ->make(true);
        }
        return view('admin.publications.blog.index');
    }

    public function updateStatus(Request $request, $id)
    {

        try {
            $notification = PublicationBlog::findOrFail($id);
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
            $n = PublicationBlog::findOrFail($id);
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

    public function store(StorePublicationRequest $request)
    {

        //Check condition 
        $blogId = $request->edit_blog_id;

        try {
            $blog = $blogId ? PublicationBlog::findOrFail($blogId) : new PublicationBlog();

            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->slug = $this->generateUniqueSlug($request->title, $blog->title, $blog->id);
            $blog->meta_title  = $request->meta_title;
            $blog->description = $request->meta_description;
            // Single image logic (works for both)
            if ($request->hasFile('blog_image')) {
                $blog_image = ImageService::uploadOrUpdate(
                    $request->file('blog_image'),
                    $blog->blog_image ?? '',
                    'publication_blog',
                    ['width' => 75, 'height' => 79], // fixed typo
                    true // need thumbnial pass true
                );
                $blog->blog_image = $blog_image;
            }

            $blog->save();
            $message = $blogId ? 'Updated' : 'Created';
            return success_response($blog, "Blog {$message} successfully!");
        } catch (\Exception $e) {
            dd($e);
            return error_response('Failed to create notification: ' . $e->getMessage(), 500);
        }
    }

    public function pdfDownload($id)
    {
        try {
            $decodedId = (int) base64_decode($id);
            $data = PublicationBlog::find($decodedId);
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
            $notification = PublicationBlog::findOrFail($id);
            $notification->start_date = basicDateFormat($notification->start_date);
            $notification->end_date = basicDateFormat($notification->end_date);
            // Return raw date format for edit form
            $notificationData = $notification->toArray();
            return success_response($notificationData, 'Notification view');
        } catch (\Exception $e) {
            return error_response('Failed to fetch notification: ' . $e->getMessage(), 500);
        }
    }

    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $base = Str::slug($title, '_');
        if ($base === '') {
            $base = 'blog';
        }
        $checkSlug = PublicationBlog::where('slug', $base)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->count();
        if ($checkSlug > 0) {
            $base = $base . '_' . $checkSlug;
        }
        $slug = $base;
        return $slug;
    }
}
