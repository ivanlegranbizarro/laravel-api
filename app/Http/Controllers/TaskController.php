<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): JsonResponse
  {
    $tasks = Task::all();
    return response()->json(new TaskCollection($tasks), 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreTaskRequest $request)
  {
    $data = $request->validated();
    Task::create($data);
    return response()->json(['message' => 'Task created'], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Task $task)
  {
    return response()->json(new TaskCollection($task), 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateTaskRequest $request, Task $task)
  {
    $data = $request->validated();
    $task->update($data);
    return response()->json(['message' => 'Task updated'], 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Task $task)
  {
    $task->delete();
    return response()->json(['message' => 'Task deleted'], 200);
  }
}
