<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Masseur;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MasseurController extends Controller
{


  protected $user;


  public function __construct(UserInterface $user)
  {
    $this->user = $user;
  }


  public function index()
  {
    return view('center.dashboard.Annalytics.masseurs');
  }



  public function getAllMasseurs(Request $request)
  {
    if (!$request->ajax()) {
      abort(404);
    }

    $today = Carbon::today();
    $startOfWeek = Carbon::now()->startOfWeek();
    $startOfYear = Carbon::now()->startOfYear();

    $massageCenterId = Auth::user()->id;
    $latestVisitor = Visitor::select('date')
      ->whereColumn('visitors.masseur_id', 'masseurs.id')
      ->latest('date')
      ->limit(1);

    $masseurs = Masseur::where('user_id', $massageCenterId)
      ->select('masseurs.*')
      ->selectSub($latestVisitor, 'latest_visitor_date')
      ->orderByDesc('latest_visitor_date');

    $getVisitorCount = function ($masseurId, $page, $fromDate) {
      return Visitor::where('masseur_id', $masseurId)->where('page', $page)->where('date', '>=', $fromDate)->count();
    };

    return DataTables::of($masseurs)

      ->addColumn('masseur', function ($row) {
        
        return '<img src="' . $row->profile_img . '" alt="' . $row->name . '" class="img-fluid rounded-circle" style="width: 50px; height: 50px;"> ' . $row->name ?? 'NA';
      })
      ->addColumn('status', function ($row) {
        return $row->status == 1 ? 'Active' : 'Inactive';
      })

      ->addColumn('profile_today', function ($row) use ($getVisitorCount, $today) {
        return $getVisitorCount($row->id, 'masseur profile', $today);
      })

      ->addColumn('profile_this_week', function ($row) use ($getVisitorCount, $startOfWeek) {
        return $getVisitorCount($row->id, 'masseur profile', $startOfWeek);
      })

      ->addColumn('profile_year_to_date', function ($row) use ($getVisitorCount, $startOfYear) {
        return $getVisitorCount($row->id, 'masseur profile', $startOfYear);
      })

      // Media
      ->addColumn('media_today', function ($row) use ($getVisitorCount, $today) {
        return $getVisitorCount($row->id, 'massure media', $today);
      })

      ->addColumn('media_this_week', function ($row) use ($getVisitorCount, $startOfWeek) {
        return $getVisitorCount($row->id, 'massure media', $startOfWeek);
      })

      ->addColumn('media_year_to_date', function ($row) use ($getVisitorCount, $startOfYear) {
        return $getVisitorCount($row->id, 'massure media', $startOfYear);
      })
    ->rawColumns(['masseur'])

      ->make(true);
  }
}
