<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\TaskStatus;
use App\Enums\TaskPriority;


class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'due_date',
    ]; //Indica qué atributos permitimos asignar mediante asignación masiva.

    protected $casts = [
        
        'priority' => TaskPriority::class,
        'status' => TaskStatus::class,
        'due_date' => 'date',
    ];
}
