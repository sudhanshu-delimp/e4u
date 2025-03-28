<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Repositories\User\UserInterface;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected $user;

     public function __construct(UserInterface $user)
     {
            $this->country = $user;
     }

    public function list(Request $request)
    {
        $countries = $this->user->searchCoach($request->get('query'));
        return response()->json($countries);
    }


}
