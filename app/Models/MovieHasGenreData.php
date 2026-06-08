<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieHasGenreData extends Model
{
    protected $table = 'movie_has_genre_data';
    protected $primaryKey = 'pid_movie_has_genre';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'movie_pid_movie',
        'genre_pid_movie'
    ];
}