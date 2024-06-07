<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): JsonResponse
  {
    $tasks = QueryBuilder::for(Task::class)->allowedFilters('completed')->paginate(10);

    return response()->json(new TaskCollection($tasks), 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreTaskRequest $request): JsonResponse
  {
    $data = $request->validated();
    Task::create($data);
    return response()->json(['message' => 'Task created'], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Task $task): JsonResponse
  {
    return response()->json(new TaskCollection($task), 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateTaskRequest $request, Task $task): JsonResponse
  {
    $data = $request->validated();
    $task->update($data);
    return response()->json(['message' => 'Task updated'], 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Task $task): JsonResponse
  {
    $task->delete();
    return response()->json(['message' => 'Task deleted'], 200);
  }
}
