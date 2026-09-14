<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Escort;
use App\Models\Notebox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteBoxController extends Controller
{

    public function index(Request $request, $profile_id = null)
    {
        $profile_data = null;
        if ($profile_id) {
            $profile_data = Escort::findOrFail($profile_id);
        }

        $states = config('escorts.profile.states');
        $genders = config('escorts.profile.genders');
       
        return view('user.dashboard.notebox.new', compact('profile_data', 'states','genders'));
    }

    public function storeNotesBox(Request $request)
    {
        $validated = $request->validate([
            // Required fields
            'escort_type' => 'required',
            'stage_name' => 'required|string|max:255',
            'mobile' => 'required',
            'advertised_price_per_hour' => 'required',
            'state' => 'required',
            'location' => 'required',
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


    public function myNotesBox()
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
                             href="' . route('user.edit-notebox', [$row->id]) . '">
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

    public function editNotebox($id)
    {
        $report = NoteBox::findOrFail($id);
        $states = config('escorts.profile.states');
        $genders = config('escorts.profile.genders');
        return view('user.dashboard.notebox.edit-notebox', compact('report', 'states', 'genders'));
    }

    public function updateNotesBox(Request $request)
    {
        $validated = $request->validate([
            // Required fields
            'escort_type' => 'required',
            'stage_name' => 'required|string|max:255',
            'mobile' => 'required',
            'advertised_price_per_hour' => 'required',
            'state' => 'required',
            'location' => 'required',
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

        $noteBox = NoteBox::findOrFail($request->notebox_id);

        /*
     * Update image only if a new image is uploaded.
     * Otherwise, keep the existing image.
     */
        if ($request->hasFile('profile_pic')) {

            // Delete old image if it exists
            if (!empty($noteBox->profile_pic)) {
                Storage::disk('escorts')->delete(
                    'uploads/notebox/' . $noteBox->profile_pic
                );
            }

            $file = $request->file('profile_pic');

            $filename = time() . '_' . $file->getClientOriginalName();

            Storage::disk('escorts')->put(
                'uploads/notebox/' . $filename,
                file_get_contents($file)
            );

            $validated['profile_pic'] = $filename;
        } else {
            // Keep existing image
            unset($validated['profile_pic']);
        }

        $noteBox->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Note box updated successfully.'
        ]);
    }

    public function deleteNotesBox($id)
    {
        $noteBox = NoteBox::findOrFail($id);

        // Delete the associated image if it exists
        if (!empty($noteBox->profile_pic)) {
            Storage::disk('escorts')->delete(
                'uploads/notebox/' . $noteBox->profile_pic
            );
        }

        $noteBox->delete();

        return response()->json([
            'success' => true,
            'message' => 'Note box deleted successfully.'
        ]);
    }
}
