<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Repositories\Escort\EscortInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function fetchTask(Request $request)
    {
        $data = Task::orderByRaw("CASE 
            WHEN status = 'open' THEN 0 
            WHEN status = 'inprogress' THEN 1 
            ELSE 2 
        END")
        ->orderByDesc('id') // then by newest
        ->paginate(7);

        return response()->json([
            'status' => true,
            'data' => $data,
            'task_name' => 'fetch_task'
        ], 200, [
            'Content-Type' => 'application/json',
        ]);
    }

    public function addTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'task_priority' => 'required',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = new Task();
        $task->title = $request->title;
        $task->priority = $request->task_priority;
        $task->description = $request->description;
        $task->status = 'open';
        $task->user_id = Auth::user()->id;
        $task->save();

        return response()->json(['success' => true, 'task' => $task,'task_name' => 'add_task']);
    }

    public function editTask($id)
    {

    }

    public function updateTask(Request $request,$id)
    {
        $task = Task::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'priority' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task->update($request->all());

        return response()->json(['success' => true, 'task' => $task,'task_name' => 'update_task']);
    }

    public function statusTask(Request $request)
    {
        dd($request->all());
    }

    public function openTask(Request $request)
    {
        $openCount = Task::where('status', 'open')->count();
        $inprogressCount = Task::where('status', 'inprogress')->count();
        $completedCount = Task::where('status', 'completed')->count();

        return response()->json([
            'status' => true,
            'data' => [
                'open' => $openCount,
                'inprogress' => $inprogressCount,
                'completed' => $completedCount
            ],
            'task_name' => 'open'
        ]);
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

}
