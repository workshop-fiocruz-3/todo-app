@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Minhas Tarefas</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
            Adicionar Nova Tarefa
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Sucesso!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if ($tasks->isEmpty())
        <p class="text-gray-600 text-lg">Nenhuma tarefa encontrada. Que tal adicionar uma nova?</p>
    @else
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <ul class="divide-y divide-gray-200">
                @foreach ($tasks as $task)
                    <li class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 {{ $task->completed ? 'line-through text-gray-500' : '' }}">{{ $task->title }}</h2>
                                @if ($task->description)
                                    <p class="text-gray-600 mt-1">{{ $task->description }}</p>
                                @endif
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('tasks.show', $task->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Ver</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-green-600 hover:text-green-900 text-sm font-medium">Editar</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

