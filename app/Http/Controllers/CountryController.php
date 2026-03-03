<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Repositories\Country\CountryInterface;
use App\Models\User;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected $country;

     public function __construct(CountryInterface $country)
     {
            $this->country = $country;
     }

    public function countryList(Request $request)
    {
        $countries = $this->country->search($request->get('query'));
        return response()->json($countries);
    }

    public function getCountyByUserId($user_id = 0)
    {
      $user = User::with('country')->find($user_id);
      return response()->json([
        'status' => true,
        'country_id' => $user->country->id,
        'country_name' => $user->country->name
    ]);
    }


}
