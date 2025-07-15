<?php

namespace App\Http\Controllers\Agent;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\AgentRequest;
use App\Models\AgentRequest as AgentModel;

class AgentRequestController extends Controller
{
    
    public function agentRequest(AgentRequest $request)
    {
        
            $refNumber = random_string();
            $agent = [
            'user_id' => auth()->user()->id,
            'ref_number'=> $refNumber,
            'first_name' => isset($request->first_name) ? $request->first_name : "",
            'last_name' => isset($request->last_name) ? $request->last_name : "",
            'email' => isset($request->email) ? $request->email : "",
            'mobile_number' => isset($request->mobile_number) ? $request->mobile_number : "",
            'contact_by_email' => isset($request->contact_by_email) ? $request->contact_by_email : 0,
            'contact_by_mobile' => isset($request->contact_by_mobile) ? $request->contact_by_mobile : 0,
            'comments' => isset($request->comments) ? $request->comments : "",
            'status' => 0,
            'created_on' => date('Y-m-d H:i:s'),
            
        ];

        try {
        $agent = AgentModel::create($agent);
        return redirect()->back()->with('agent_success', 'Request submitted successfully.');
        } 
        catch (Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while submitting the request.');
        }
    }



    public function newRequest(Request $request)
    {
            $query = AgentModel::with('user','user.state')->where('status','0');
            $search = $request->query('search');
             if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('ref_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('member_id', 'like', "%{$search}%");
                     });
                });
            }
            $lists = $query->orderBy('id', 'desc')->paginate(3);
            if ($request->ajax()) {
                return view('agent.dashboard.Advertisers.agent-requests-list', compact('lists'))->render();
            }

            return view('agent.dashboard.Advertisers.new-requests', compact('lists'));   
    }

    public function processRequest(Request $request)
    {
       
        if((isset($request->id)) && (isset($request->request_type)))
        {
            if($request->request_type=='accept')
            $status = '1';

            if($request->request_type=='reject')
            $status = '2';

            AgentModel::where('id', $request->id)->update(['status'=>$status]);
            return response()->json(['success' => true]);

        }
        else
        {
            return response()->json(['success' => false]); 
        }

    }



    public function historyRequests(Request $request)
    {

         $query = AgentModel::with('user','user.state')->where('status','1')->orWhere('status','2');
            $search = $request->query('search');
             if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('ref_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('member_id', 'like', "%{$search}%");
                     });
                });
            }
            $lists = $query->orderBy('id', 'desc')->paginate(3);
            if ($request->ajax()) {
                return view('agent.dashboard.Advertisers.history-requests-list', compact('lists'))->render();
            }

            return view('agent.dashboard.Advertisers.history-requests', compact('lists')); 

    }
}
