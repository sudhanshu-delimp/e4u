<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notebox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteBoxController extends Controller
{

    public function index(Request $request)
    {
        return view('user.dashboard.notebox.new');
    }

    public function storeReport(Request $request)
    {
        $validated = $request->validate([
            // Required fields
            'escort_type' => 'required',
            'stage_name' => 'required|string|max:255',
            'mobile' => 'required',
            'advertised_price_per_hour' => 'required',
            'state' => 'required',
            'location' => 'required',
            'summary_of_encounter' => 'required|string',
            'status_type' => 'required',
            'rating' => 'required',

            // Optional fields
            'meeting_type' => 'nullable',
            'extras_charged' => 'nullable',
            'photos_authenticity' => 'nullable',
            'ethnicity' => 'nullable',
            'nationality' => 'nullable',
            'estimated_age' => 'nullable',
            'body_shape' => 'nullable',
            'overall_looks' => 'nullable',
            'overall_personality' => 'nullable',
            'bd' => 'nullable',
            'blowjob' => 'nullable',
            'oral_on_escort' => 'nullable',
            'anal_sex' => 'nullable',
            'overall_performance' => 'nullable',
            'met_profile_undertakings' => 'nullable',
            'drug_consumption' => 'nullable',
            'platform' => 'nullable',
            'profile_link' => 'nullable',

            // Optional image
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            Storage::disk('escorts')->put('uploads/notebox/' . $filename, file_get_contents($file));
            $validated['profile_pic'] = $filename;
        }

        NoteBox::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Note box submitted successfully.'
        ]);
    }


    public function myReports()
    {
        $reports = NoteBox::orderBy('id', 'desc')
            ->get()
            ->map(function ($row) {
                if ($row->profile_pic) {
                    $row->profile_pic = 
                        '/escorts/uploads/notebox/' . $row->profile_pic;
                }
                $row->actions = '
                <div class="dropdown no-arrow text-center">
                    <a class="dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>

                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in">
                       
                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 edit_report"
                            href="">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 delete_report"
                            href="#"
                            data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                            <div class="dropdown-divider"></div>
                          <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 view_report"
                            href="#"
                            data-id="' . $row->id . '">
                            <i class="fa fa-eye"></i> View
                        </a>

                    </div>
                </div>
            ';
                return $row;
            });

        return response()->json([
            'data' => $reports,
            'today' => NoteBox::whereDate('created_at', today())->count(),
            'this_month' => NoteBox::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'this_year' => NoteBox::whereYear('created_at', now()->year)->count(),
            'all_time' => NoteBox::count(),
        ]);
    }
}
