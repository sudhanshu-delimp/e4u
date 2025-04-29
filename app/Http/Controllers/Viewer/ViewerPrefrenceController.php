<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\ViewerInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewerPrefrenceController extends Controller
{
    public function getViewerPrefrence(Request $request)
    {
        $user =  Auth::user();
        if (!$user) {
            abort(404, 'please register yourself first.');
        }

         // Save or update to database
         $preference = ViewerInterest::where('user_id',  $user->id)->first();

        //  dd($preference);

         return view('user.dashboard.change-features',['preference'=>$preference]);
    }

    public function setViewerPrefrence(Request $request)
    {
        $user =  Auth::user();
        if (!$user) {
            abort(404, 'please register yourself first.');
        }

        $validated = $request->validate([
            'features' => 'nullable|array',
            'notifications' => 'nullable|array',
            'interests' => 'nullable|array',
            'city' => 'nullable|string',
        ]);

         // Save or update to database
         $preference = ViewerInterest::updateOrCreate(
            ['user_id' => $user->id], 
            [
                'features' => isset($request->features) ? json_encode($validated['features']) : null,
                'notifications' => isset($request->notifications) ? json_encode($validated['notifications']) : null,
                'interests' => isset($request->interests) ? json_encode($validated['interests']) : null,
                'city' => $validated['city'] ?? null
            ]
        );

        if($preference){
            return redirect()->back()->with('success','Preference updated successfully.');
        }

        return redirect()->back()->with('error','Something is wrong! Please try again.');
        
        
    }
}
