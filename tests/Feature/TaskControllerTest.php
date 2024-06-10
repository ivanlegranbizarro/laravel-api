<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
  use RefreshDatabase;

  public function test_obtener_todas_las_tareas(): void
  {
    //Preparar las tareas
    $user = User::factory()->create();
    $task = Task::factory()->create([
      'user_id' => $user->id
    ]);

    // Autenticar al usuario
    $this->actingAs($user, 'api');

    // Realizar las acciones necesarias

    $respuesta = $this->getJson('/api/tasks');


    // Comprobar el estado final

    $respuesta->assertOk();
    $respuesta->assertJsonFragment([
      'id' => $task->id,
      'title' => $task->title,
      'completed' => $task->completed
    ]);
  }

  public function test_un_usuario_puede_crear_una_task(): void
  {
    //Preparar las tareas
    $user = User::factory()->create();

    // Autenticar al usuario
    $this->actingAs($user, 'api');

    // Realizar las acciones necesarias
    $respuesta = $this->postJson('/api/tasks', [
      'title' => 'Comprar comida para Concha'
    ]);

    // Comprobar el estado final
    $respuesta->assertCreated();
  }
}
