<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use App\Models\Masseur;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;
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

       $latestVisitor = Visitor::select('date')
        ->whereColumn('visitors.masseur_id', 'masseurs.id')
        ->latest('date')
        ->limit(1);

    $masseurs = Masseur::query()
        ->select('masseurs.*')
        ->selectSub($latestVisitor, 'latest_visitor_date')
        ->orderByDesc('latest_visitor_date');

    return DataTables::of($masseurs)

      ->addColumn('masseur', function ($row) {
        return $row->name ?? 'NA';
      })
      // ->editColumn('id', function ($row) {
      //   return str_pad($row->id, 3, '0', STR_PAD_LEFT);
      // })

      ->addColumn('status', function ($row) {
        return $row->status == 1 ? 'Active' : 'Inactive';
      })

      ->addColumn('profile_today', function ($row) use ($today) {
        return Visitor::where('masseur_id', $row->id)
          ->where('page', 'masseur profile')
          ->where('date', '>=', $today)
          ->count();
      })

      ->addColumn('profile_this_week', function ($row) use ($startOfWeek) {
        return Visitor::where('masseur_id', $row->id)
          ->where('page', 'masseur profile')
          ->where('date', '>=', $startOfWeek)
          ->count();
      })

      ->addColumn('profile_year_to_date', function ($row) use ($startOfYear) {
        return Visitor::where('masseur_id', $row->id)
          ->where('page', 'masseur profile')
          ->where('date', '>=', $startOfYear)
          ->count();
      })

      ->addColumn('media_today', function ($row) use ($today) {
        return Visitor::where('masseur_id', $row->id)
          ->where('page', 'massure media')
          ->where('date', '>=', $today)
          ->count();
      })

      ->addColumn('media_this_week', function ($row) use ($startOfWeek) {
        return Visitor::where('masseur_id', $row->id)
          ->where('page', 'massure media')
          ->where('date', '>=', $startOfWeek)
          ->count();
      })

      ->addColumn('media_year_to_date', function ($row) use ($startOfYear) {
        return Visitor::where('masseur_id', $row->id)
          ->where('page', 'massure media')
          ->where('date', '>=', $startOfYear)
          ->count();
      })

      ->make(true);
  }
}
