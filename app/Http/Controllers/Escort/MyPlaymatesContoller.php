<?php
namespace App\Http\Controllers\Escort;
use App\Http\Controllers\Controller;
use App\Repositories\Playmate\PlaymateInterface;
use App\Models\Escort;
use App\Models\Playmate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPlaymatesContoller extends Controller
{
    protected $playmate;
    public function __construct(PlaymateInterface $playmate)
    {
        $this->playmate = $playmate;
    }

    public function index()
    {
        return view('escort.dashboard.my-playmates');
    }

    public function myPlaymateDataTable(Request $request){
        $conditions = [];
        list($result, $count, $other) = $this->playmate->paginatedGroupedList(
            request()->get('start'),
            request()->get('length'),
            request()->get('order')[0]['column'],
            request()->get('order')[0]['dir'],
            request()->get('columns'),
            request()->get('search')['value'],
            auth()->user()->id,
            $conditions
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "other" => $other,
            "data"            => $result
        );

        return response()->json($data);
    }

    public function getPlaymateListingsDataTable(Request $request){
        $conditions = [];
        $conditions['is_deleted'] = '0';
        list($result, $count, $other) = $this->playmate->paginatedList(
            $request->get('start'),
            $request->get('length'),
            $request->get('order')[0]['column'],
            $request->get('order')[0]['dir'],
            $request->get('columns'),
            $request->get('search')['value'],
            $request->get('escort_id'),
            $conditions
        );

        $data = array(
            "draw"            => intval(request()->input('draw')),
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "other" => $other,
            "data"            => $result
        );

        return response()->json($data);
    }

    public function trashPlaymateHistory(Request $request){
        try {
            $response['success'] = false;
            $playmateHistoryId = $request->playmateHistoryId;
            $history = $this->playmate->find($playmateHistoryId);
            $history->escort->playmates()->detach($history->playmate_id); /** Remove Playmate from Escort's PlaymateList */
            $history->playmate->playmates()->detach($history->escort_id); /** Remove Escort from Playmate's PlaymateList */
            $this->playmate->trashPlaymateHistory($history->escort_id, $history->playmate_id); /** Update is_deleted in the playmate history table in reverse order  */
            $response['success'] = true;
            $response['message'] = "Removed successfully.";

            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
