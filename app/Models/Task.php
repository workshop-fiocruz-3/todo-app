<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Task Model - Modelo que representa uma tarefa no sistema.
 *
 * Cada tarefa possui:
 * - id: Identificador único
 * - title: Título da tarefa (obrigatório)
 * - description: Descrição detalhada da tarefa (opcional)
 * - completed: Status de conclusão da tarefa (boolean)
 * - created_at: Data e hora de criação
 * 
 * - updated_at: Data e hora da última atualização
 */


class Task extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'completed',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * Escopo para filtrar apenas tarefas concluídas.
     *
     * Uso: Task::completed()->get()
     *
     * @param  Builder $query Instância do construtor de consultas Eloquent.
     * @return Builder Consulta modificada apenas com tarefas concluídas.
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('completed', true);
    }

    /**
     * Escopo para filtrar apenas tarefas pendentes.
     *
     * Uso: Task::pending()->get()
     *
     * @param Builder $query Instância do construtor de consultas Eloquent.
     * @return Builder Consulta modificada apenas com tarefas pendentes.
     */
    public function scopePending(Builder  $query): Builder
    {
        return $query->where('completed', false);
    }

    /**
     * Verifica se a tarefa está concluída.
     *
     * @return  boolean Verdadeiro se a tarefa estiver concluída, falso caso contrário.
     */
    public function isCompleted(): bool
    {
        return (bool) $this->completed;
    }

    /**
     * Marca a tarefa como concluída.
     *
     * @return boolean Verdadeiro se a atualização for bem-sucedida.
     */
    public function markAsCompleted(): bool
    {
        return $this->update(['completed' => true]);
    }

    /**
     * Marca a tarefa como pendente.
     *
     * @return boolean Verdadeiro se a atualização for bem-sucedida.
     */
    public function markAsPending(): bool
    {
        return $this->update(['completed' => false]);
    }

}
