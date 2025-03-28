<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Repositories\Country\CountryInterface;

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


}
