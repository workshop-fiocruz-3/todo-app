<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    

    /**
     * Testa se a página de índice de tarefas pode ser acessada.
     *
     * @return void
     */
    public function test_tasks_index_page_can_be_rendered()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
    }

    /**
     * Testa se uma tarefa pode ser criada.
     *
     * @return void
     */
    public function test_task_can_be_created()
    {
        $response = $this->post('/tasks', [
            'title' => 'Nova Tarefa',
            'description' => 'Descrição da nova tarefa.',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Nova Tarefa',
            'description' => 'Descrição da nova tarefa.',
        ]);
    }

    /**
     * Testa se uma tarefa pode ser atualizada.
     *
     * @return void
     */
    public function test_task_can_be_updated()
    {
        $task = Task::factory()->create([
            "title" => "Tarefa Antiga",
            "description" => "Descrição Antiga",
        ]);

        $response = $this->put('/tasks/' . $task->id, [
            'title' => 'Tarefa Atualizada',
            'description' => 'Descrição Atualizada',
            'completed' => true,
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Tarefa Atualizada',
            'description' => 'Descrição Atualizada',
            'completed' => true,
        ]);
    }

    /**
     * Testa se uma tarefa pode ser excluída.
     *
     * @return void
     */
    public function test_task_can_be_deleted()
    {
        $task = Task::factory()->create();

        $response = $this->delete('/tasks/' . $task->id);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /**
     * Testa a validação ao criar uma tarefa sem título.
     *
     * @return void
     */
    public function test_task_creation_requires_title()
    {
        $response = $this->post('/tasks', [
            'description' => 'Descrição sem título.',
        ]);

        $response->assertSessionHasErrors('title');
    }
}

