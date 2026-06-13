<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieData extends Model
{
    protected $table            = 'movie_movie_data';
    protected $primaryKey       = 'pid_movie';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'title',
        'description',
        'release_date',
        'duration',
        'rating',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
