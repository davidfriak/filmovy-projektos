<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieHasActor1 extends Model
{
    protected $table = 'movie_movie_has_actor_1';
    protected $primaryKey = 'id_movie_has_actor';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'role_name',
        'movie_id_movie',
        'actor_id_actor'
    ];
}