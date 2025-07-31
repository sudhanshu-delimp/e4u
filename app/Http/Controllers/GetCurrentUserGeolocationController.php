<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetCurrentUserGeolocationController extends Controller
{
    public function getRealTimeGeo(Request $request)
    {
        $lat = $request->input('data.lat');
        $lng = $request->input('data.lng');

        // Call your helper function
        $result = getRealTimeGeolocationOfUsers($lat, $lng);

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
}
