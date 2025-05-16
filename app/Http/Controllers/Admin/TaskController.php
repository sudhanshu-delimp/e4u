<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\User\UserInterface;

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::create($validated);
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
