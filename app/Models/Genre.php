<?php

namespace App\Models;

use CodeIgniter\Model;

class Genre extends Model
{
    protected $table = 'movie_genre';
    protected $primaryKey = 'pid_genre';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'name',
        'description'
    ];
}