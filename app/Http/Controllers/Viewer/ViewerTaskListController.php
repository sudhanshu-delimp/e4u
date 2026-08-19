<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ViewerTaskListController extends Controller
{
  // i re-use for code

  // i m just move right source code from TaskController to TaskListController for escort dashboard task list SHS


  public function index()
  {
    return view('user.dashboard.ticket.task-list');
  }

  // public function fetchTask(Request $request)
  // {
  //     $data = Task::select('tasks.*')
  //     ->addSelect(DB::raw("CASE
  //         WHEN status = 'open' THEN 'badge_open'
  //         WHEN status = 'inprogress' THEN 'badge_inProgress'
  //         WHEN status = 'completed' THEN 'badge_completed'
  //         ELSE 'badge_default'
  //     END as status_color_class"))
  //     ->orderByRaw("CASE 
  //         WHEN status = 'inprogress' THEN 0 
  //         WHEN status = 'open' THEN 1 
  //         ELSE 2 
  //     END")
  //     ->orderByRaw("CASE 
  //         WHEN priority = 'high' THEN 0 
  //         WHEN priority = 'medium' THEN 1 
  //         ELSE 2 
  //     END")
  //     ->orderByDesc('id') 
  //     ->where('user_id',Auth::user()->id)
  //     ->paginate(10);




  //     return response()->json([
  //         'status' => true,
  //         'data' => $data,
  //         'task_name' => 'fetch_task'
  //     ], 200, [
  //         'Content-Type' => 'application/json',
  //     ]);
  // }

  public function fetchTask(Request $request)
  {
    $tasks = Task::select(
      'tasks.*',
      DB::raw("CASE
                WHEN status = 'open' THEN 'badge_open'
                WHEN status = 'inprogress' THEN 'badge_inProgress'
                WHEN status = 'completed' THEN 'badge_completed'
                ELSE 'badge_default'
            END as status_color_class")
    )
      ->where('user_id', Auth::id())
      ->orderByRaw("CASE
            WHEN status = 'inprogress' THEN 0
            WHEN status = 'open' THEN 1
            ELSE 2
        END")
      ->orderByRaw("CASE
            WHEN priority = 'high' THEN 0
            WHEN priority = 'medium' THEN 1
            ELSE 2
        END")
      ->orderByDesc('id');

    return DataTables::of($tasks)

      ->addColumn('task', function ($task) {

        $priorityColor = match ($task->priority) {
          'high' => 'text-danger',
          'medium' => 'text-warning',
          default => 'text-success',
        };

        return '
                <label class="mb-0 cursor-pointer">
                    <i class="fas fa-circle ' . $priorityColor . ' taski mr-2"></i>
                    ' . e($task->title) . '
                </label>
            ';
      })

      ->addColumn('status', function ($task) {

        $statusLabel = match ($task->status) {
          'open' => 'Open',
          'inprogress' => 'In Progress',
          'completed' => 'Completed',
          default => ucfirst($task->status),
        };

        return '
                <span class="custom_badge ' . ($task->status_color_class ?? '') . '">
                    ' . $statusLabel . '
                </span>
            ';
      })

      ->addColumn('action', function ($task) {

        $taskId = $task->id;
        $menuId = 'taskMenu_' . $taskId;

        return '
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle"
                       href="#"
                       role="button"
                       id="' . $menuId . '"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">

                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>

                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                         aria-labelledby="' . $menuId . '">

                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown"
                           href="#"
                           id="edit_task"
                           data-id="' . $taskId . '">
                            <i class="fa fa-pen"></i> Edit Task
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown"
                           href="#"
                           id="complete_task"
                           data-id="' . $taskId . '">
                            <i class="fa fa-check-circle"></i> Complete Task
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown"
                           href="#"
                           id="view_task"
                           data-id="' . $taskId . '">
                            <i class="fa fa-eye"></i> View
                        </a>

                    </div>
                </div>
            ';
      })

      ->rawColumns(['task', 'status', 'action'])
      ->make(true);
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

    return response()->json(['success' => true, 'task' => $task, 'task_name' => 'add_task']);
  }

  public function editTask(Request $request)
  {
    $task = Task::where('user_id', Auth::user()->id)->findOrFail($request->id);
    return response()->json(['success' => true, 'task' => $task, 'task_name' => 'edit_task']);
  }

  public function updateTask(Request $request)
  {
    $task = Task::where('user_id', Auth::user()->id)->findOrFail($request->task_id);

    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'task_priority' => 'required',
      'description' => 'nullable',
      'status' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    $task->update([
      'title' => $request->title,
      'priority' => $request->task_priority,
      'description' => $request->description,
      'status' => $request->status,
    ]);

    return response()->json(['success' => true, 'task' => $task, 'task_name' => 'update_task']);
  }

  public function statusTask(Request $request)
  {
    $task = Task::where('user_id', Auth::user()->id)->findOrFail($request->change_task_id);
    $task->update([
      'status' => 'completed',
    ]);

    return response()->json(['success' => true, 'task' => $task, 'task_name' => 'complete_task']);
  }

  public function openTask(Request $request)
  {
    $openCount = Task::where('status', 'open')->where('user_id', Auth::user()->id)->count();
    $inprogressCount = Task::where('status', 'inprogress')->where('user_id', Auth::user()->id)->count();
    $completedCount = Task::where('status', 'completed')->where('user_id', Auth::user()->id)->count();

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
    Task::where('user_id', Auth::user()->id)->findOrFail($id)->delete();
    return response()->json(['success' => true]);
  }
}
