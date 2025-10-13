<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Task Model - Modelo que representa uma tarefa no sistema
 * 
 * Este modelo gerencia as tarefas do sistema de gerenciamento de tarefas.
 * Cada tarefa possui:
 * - id: Identificador único
 * - title: Título da tarefa (obrigatório)
 * - description: Descrição detalhada da tarefa (opcional)
 * - completed: Status de conclusão da tarefa (boolean)
 * - created_at: Data e hora de criação
 * - updated_at: Data e hora da última atualização
 */
class Task extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa
     * 
     * Define quais campos podem ser preenchidos através de
     * operações em massa como create() e update()
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'completed',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos
     * 
     * O campo 'completed' é automaticamente convertido para boolean
     * quando acessado ou modificado
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * Escopo para filtrar apenas tarefas concluídas
     * 
     * Uso: Task::completed()->get()
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Escopo para filtrar apenas tarefas pendentes
     * 
     * Uso: Task::pending()->get()
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('completed', false);
    }

    /**
     * Verifica se a tarefa está concluída
     * 
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * Marca a tarefa como concluída
     * 
     * @return bool
     */
    public function markAsCompleted()
    {
        return $this->update(['completed' => true]);
    }

    /**
     * Marca a tarefa como pendente
     * 
     * @return bool
     */
    public function markAsPending()
    {
        return $this->update(['completed' => false]);
    }
}

