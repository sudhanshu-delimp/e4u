<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MonthlyReportQuery;
use App\Models\AgentMonthlyReport;
use App\Models\OperatorMonthlyReport;
use Exception;

class MonthlyReportQueryController extends BaseController
{
    /**
     * Update the status
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function monthlyReportQuery(Request $request)
    {
        $report = true;
        try {
            $data = $request->all();
            $userId = auth()->user()->id;
            if ($data) {
                $id = $data['id'];
                $status = $data['status'];
                $reportFor = $data['report_for'];
                $note = trim($data['note']) ?? "";
                if (empty($note)) {
                    return $this->errorResponse('Please write the your query.');
                }
                if ($reportFor == 'operator') {
                    $report = OperatorMonthlyReport::where('id', $id)->first();
                } else {
                    $report = AgentMonthlyReport::where('id', $id)->first();
                }

                if ($report) {
                    $report->status = 'query';

                    if ($report->save()) {

                        $userType = auth()->user()->type;
                        $reportQueryObj = (new MonthlyReportQuery);
                        $reportQueryObj->fee_report_id = $id;
                        $reportQueryObj->status = $status;
                        $reportQueryObj->submitted_by = $userId;
                        $reportQueryObj->user_type = $userType;
                        $reportQueryObj->report_date = date('Y-m-d H:i:s');;
                        $reportQueryObj->notes = $note;
                        $reportQueryObj->save();

                        $msg = 'Query submitted successfully';
                        return $this->successResponse($msg);
                    }
                } else {
                    return $this->errorResponse('Monthly fee report data not found.');
                }
            }
        } catch (\Throwable $e) {
            \Log::error('Error saving monthly report query for user ' . $e->getMessage());
        }
        return $this->errorResponse('Error occurred while updating the status.');
    }

    /**
     * View the monthly fee queries
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function viewQuery(Request $request)
    {
        try {
            $results = [];
            $userId = auth()->user()->id;
            $userType = auth()->user()->type;
            $data = $request->all();
            $msg['sender'] = [];
            $msg['reciever'] = [];
            if (isset($data['id']) && $data['id'] > 0) {
                $id = $data['id'];
                $queryObj = (new MonthlyReportQuery);

                $queryData = $queryObj->with('submittedBy')
                    ->where('fee_report_id', $id)
                    ->where('status', 'query')
                    ->where('notes', '!=', "")
                    ->orderBy("created_at", "DESC")
                    ->get();
                   // ->groupBy('user_type');

                if ($queryData->isNotEmpty()) {
                    //print_r($queryData->toArray());die;
                    $i = 0;
                    foreach ($queryData as $result) {
                        if ($userType == $result->user_type) {
                            $msg['sender'][$i]['member_id'] = $result->submittedBy->member_id;
                            $msg['sender'][$i]['email'] = $result->submittedBy->email;
                            $msg['sender'][$i]['name'] = ($result->user_type == '5')? $result->submittedBy->business_name :$result->submittedBy->name;
                            $msg['sender'][$i]['notes'] = $result->notes;
                            $msg['sender'][$i]['user_type'] = $result->user_type;
                            $msg['sender'][$i]['report_date'] = $result->report_date;
                        } else {
                            $msg['reciever'][$i]['member_id'] = $result->submittedBy->member_id;
                            $msg['reciever'][$i]['email'] = $result->submittedBy->email;
                            $msg['reciever'][$i]['name'] = ($result->user_type == '5')? $result->submittedBy->business_name :$result->submittedBy->name;
                            $msg['reciever'][$i]['notes'] = $result->notes;
                            $msg['reciever'][$i]['user_type'] = $result->user_type;
                            $msg['reciever'][$i]['report_date'] = $result->report_date;
                        }
                        $i++;
                    }

                    return response()->json([
                        'status' =>  true,
                        'data' => $msg,
                    ], 200);
                }
            }
        } catch (\Throwable $e) {
            \Log::error('Monthly report query not found. ' . $e->getMessage());
        }
        return response()->json([
            'status' =>  false,
            'data' => [],
        ], 200);
    }
}
