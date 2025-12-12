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

    public function MyPlaymateDataTable(Request $request){
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
}
