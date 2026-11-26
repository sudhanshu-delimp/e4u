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
        //'pending','approved','rejected','paid','query','query_resolved'
        try {
            $data = $request->all();
            $userId = auth()->user()->id;
            if ($data) {
                $id = $data['id'];
                $status = $data['status'];
                $reportFor = $data['report_for'];
                $note = trim($data['note']) ?? "";
                if (empty($note)) {
                    return $this->errorResponse('Please enter your query.');
                }
                if ($reportFor == 'operator') {
                    $report = OperatorMonthlyReport::where('id', $id)->first();
                } else {
                    $report = AgentMonthlyReport::where('id', $id)->first();
                }

                if ($report) {
                    $sreportStatus = $report->status;
                    if (in_array($sreportStatus, ['approved', 'pending', 'query_resolved', 'query'])) {
                        $report->status = 'query';
                    }

                    if ($report->save()) {

                        $userType = auth()->user()->type;
                        $reportQueryObj = (new MonthlyReportQuery);
                        $reportQueryObj->fee_report_id = $id;
                        $reportQueryObj->status = 'query';
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
            $msg = [
                'messages' => []
            ];
            if (isset($data['id']) && $data['id'] > 0) {
                $id = $data['id'];
                $queryObj = (new MonthlyReportQuery);

                $queryData = $queryObj->with('submittedBy')
                    ->where('fee_report_id', $id)
                    ->where('status', 'query')
                    ->where('notes', '!=', "")
                    ->orderBy("created_at", "ASC")
                    ->get();
                // ->groupBy('user_type');

                if ($queryData->isNotEmpty()) {
                    $i = 0;
                    foreach ($queryData as $result) {

                        if (!$result->submittedBy) {
                            continue;
                        }

                        $msg['messages'][] = [
                            'member_id'  => $result->submittedBy->member_id,
                            'email'      => $result->submittedBy->email,
                            'name'       => ($result->user_type == '5')
                                ? $result->submittedBy->business_name
                                : $result->submittedBy->name,
                            'message'    => $result->notes,
                            'user_type'  => (string) $result->user_type,
                            'report_date' => $result->report_date,
                            'created_at' => $result->created_at,
                            'side'        => ($userType == $result->user_type)
                                ? 'sender'
                                : 'receiver',
                        ];
                    }

                    return response()->json([
                        'status' =>  true,
                        'conversations' => $msg,
                    ], 200);
                }
            }
        } catch (\Throwable $e) {
            \Log::error('Monthly report query not found. ' . $e->getMessage());
        }
        return response()->json([
            'status' =>  false,
            'conversations' => [],
        ], 200);
    }
}
