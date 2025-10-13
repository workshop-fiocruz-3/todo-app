<?php

namespace Tests\Unit;

use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    /**
     * Testa se o modelo Task pode ser instanciado.
     *
     * @return void
     */
    public function test_task_can_be_instantiated()
    {
        $task = new Task();
        $this->assertInstanceOf(Task::class, $task);
    }

    /**
     * Testa se os atributos fillable estão configurados corretamente.
     *
     * @return void
     */
    public function test_task_has_fillable_attributes()
    {
        $task = new Task([
            'title' => 'Test Task',
            'description' => 'This is a test description',
            'completed' => false,
        ]);

        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('This is a test description', $task->description);
        $this->assertFalse($task->completed);
    }
}

