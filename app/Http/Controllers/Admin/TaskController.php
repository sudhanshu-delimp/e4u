<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class TaskController extends Controller
{
    protected $escort;
    protected $user;

    public function __construct(EscortInterface $escort, UserInterface $user)
    {
        $this->escort = $escort;
        $this->user = $user;

    }

    public function addTask(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'title' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'description' => 'nullable',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = Task::create($request->all());
        return response()->json(['success' => true, 'task' => $task]);
    }

    public function editTask(Request $request)
    {

    }

    public function updateTask(Request $request)
    {

    }

    public function statusTask(Request $request)
    {

    }

    public function openTask(Request $request)
    {

    }

}
