<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }
    public function show(Task $task)
    {
        return $task;
    }
    public function store(TaskStoreRequest $request)
    {
        return Task::create($request->all());
    }
    public function update(TaskUpdateRequest $request, Task $task)
    {
        \Log::info($task);
        $task->update($request->all());
        return $task;
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return $task;
    }
}
