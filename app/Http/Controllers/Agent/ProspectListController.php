<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\MassageExcel;
use Illuminate\Http\Request;

class ProspectListController extends Controller
{
    public function prospectList()
    {
        return view('agent.dashboard.Marketing.create-prospect');
    }

    public function postcodes(Request $request)
    {
        $q = $request->q;
        try {
            $searchByPostCode = MassageExcel::select('postcode')
                ->where('postcode', 'LIKE', $q . '%')
                ->distinct()->limit(10)->get();
            return success_response($searchByPostCode, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Faild to fetch database: ' . $e->getMessage(), 500);
        }
    }
}
