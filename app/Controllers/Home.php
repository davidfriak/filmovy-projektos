<?php

namespace App\Controllers;

use App\Models\MovieData;
use App\Models\ActorData;
use App\Models\Genre;

class Home extends BaseController
{
    public function index()
    {
        $movieModel = new MovieData();
        $actorModel = new ActorData();
        $genreModel = new Genre();

        $data['movieCount'] = $movieModel->countAll();
        $data['actorCount'] = $actorModel->countAll();
        $data['genreCount'] = $genreModel->countAll();

        $data['latestMovies'] = $movieModel
            ->orderBy('pid_movie', 'DESC')
            ->findAll(8);

        $data['latestActors'] = $actorModel
            ->orderBy('pid_actor', 'DESC')
            ->findAll(5);

        return view('welcome_message', $data);
    }
}