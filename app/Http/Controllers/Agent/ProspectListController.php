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
            $searchByPostCode = MassageExcel::select('post_code')
                ->where('post_code', 'LIKE', $q . '%')
                ->where('state_id', auth()->user()->state_id)
                ->distinct()->limit(10)->get();
            return success_response($searchByPostCode, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to fetch postcodes: ' . $e->getMessage(), 500);
        }
    }

    public function generateList(Request $request)
    {
        try {
            $query = MassageExcel::where('state_id', auth()->user()->state_id)
                ->whereHas('territory', function ($q) {
                    $q->where('status', 'Active');
                });

            $type = $request->type;
            if ($type === 'single' && $request->post_code) {
                $query->where('post_code', $request->post_code);
            } elseif ($type === 'multiple' && $request->from && $request->to) {
                $query->whereBetween('post_code', [$request->from, $request->to]);
            }
            // 'all' => no extra filter

            $data = $query->select('id', 'bussiness_name', 'address', 'post_code', 'mobile_number', 'business_number')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'bussiness_name' => $item->bussiness_name,
                        'address' => $item->address,
                        'post_code' => $item->post_code,
                        'mobile_number' => $item->mobile_number ?? 'NA',
                        'business_number' => $item->business_number ?? 'NA',
                    ];
                });

            return success_response($data, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to generate list: ' . $e->getMessage(), 500);
        }
    }

    public function showRecipients(Request $request)
    {
        try {
            $query = MassageExcel::where('state_id', auth()->user()->state_id)
                ->whereHas('territory', function ($q) {
                    $q->where('status', 'Active');
                });

            $type = $request->type;
            if ($type === 'single' && $request->post_code) {
                $query->where('post_code', $request->post_code);
            } elseif ($type === 'multiple' && $request->from && $request->to) {
                $query->whereBetween('post_code', [$request->from, $request->to]);
            }

            $data = $query->select('id', 'bussiness_name', 'address', 'post_code', 'mobile_number', 'business_number')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'bussiness_name' => $item->bussiness_name,
                        'address' => $item->address,
                        'post_code' => $item->post_code,
                        'mobile_number' => $item->mobile_number ?? 'NA',
                        'business_number' => $item->business_number ?? 'NA',
                    ];
                });

            return success_response($data, "Ok", 200, []);
        } catch (\Exception $e) {
            return error_response('Failed to fetch recipients: ' . $e->getMessage(), 500);
        }
    }
}
