<?php

namespace App\Models;

use CodeIgniter\Model;

class PopularMovieModel extends Model
{
    protected $table = 'movie_popular_movie';
    protected $primaryKey = 'pid_popular_movie';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'title',
        'description',
        'release_date',
        'duration',
        'rating',
        'poster',
    ];
}
