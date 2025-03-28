<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Repositories\City\CityInterface;
use App\Repositories\Escort\EscortInterface;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected $city;
     protected $escort;

     public function __construct(CityInterface $city,EscortInterface $escort)
     {
            $this->city = $city;
            $this->escort = $escort;
     }

    public function cityList(Request $request)
    {
        $cities = $this->city->search($request->get('query'), $request->get('state_id'));
        return response()->json($cities);
    }

    public function SelectedCityList(Request $request)
    {
        $cc = $this->escort->all();
        $cities = $this->escort->escortCity($request->get('query'));
        $cities_name = [];
        foreach($cities as $city)
        {
            $data = $this->city->find($city->city_id);
             $cities_name[] =  $data->name;
        }
        return response()->json($cities_name);
    }


}
