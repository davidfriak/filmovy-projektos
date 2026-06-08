<?php

namespace App\Models;

use CodeIgniter\Model;

class ActorData extends Model
{
    protected $table = 'movie_actor_data';
    protected $primaryKey = 'pid_actor';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'name',
        'surname',
        'birth_date',
        'biography',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}