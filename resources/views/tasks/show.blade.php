@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detalhes da Tarefa</h1>
        <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
            Voltar para a Lista
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-2">{{ $task->title }}</h2>
        @if ($task->description)
            <p class="text-gray-700 mb-4">{{ $task->description }}</p>
        @else
            <p class="text-gray-500 mb-4">Nenhuma descrição fornecida.</p>
        @endif
        <p class="text-sm text-gray-600">Criado em: {{ $task->created_at->format('d/m/Y H:i') }}</p>
        <p class="text-sm text-gray-600">Última atualização: {{ $task->updated_at->format('d/m/Y H:i') }}</p>
        <p class="text-sm text-gray-600">Status: <span class="font-bold {{ $task->completed ? 'text-green-600' : 'text-yellow-600' }}">{{ $task->completed ? 'Concluída' : 'Pendente' }}</span></p>

        <div class="mt-6 flex space-x-3">
            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                Editar
            </a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    Excluir
                </button>
            </form>
        </div>
    </div>
@endsection

