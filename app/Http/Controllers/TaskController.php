<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Task::create($request->all());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return View
     */
    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task  $task
     * @return View
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Task     $task
     * @return RedirectResponse
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->boolean('completed'),
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarefa excluída com sucesso.');
    }

    //  Método propositalmente com erro para demonstrar o PHPStan
    public function calculateTaskProgress($task)
    {
        // Falta ; no final do return
        return $task->completedSteps / $task->totalSteps * 100;
    }
}
