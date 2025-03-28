<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use App\Repositories\State\StateInterface;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     protected $state;

     public function __construct(StateInterface $state)
     {
            $this->state = $state;
     }

    public function stateList(Request $request)
    {
        $states = $this->state->search($request->get('query'), $request->get('country_id'));
        return response()->json($states);
    }


}
