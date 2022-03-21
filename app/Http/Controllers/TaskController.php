<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
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
}
