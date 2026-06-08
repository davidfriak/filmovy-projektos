<?php

namespace App\Controllers;

use App\Models\MovieData;

class MovieController extends BaseController
{
    protected MovieData $movieModel;

    public function __construct()
    {
        $this->movieModel = new MovieData();
    }

    private function requireLogin()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(site_url('login'))->with('error', 'Nejdřív se musíš přihlásit.');
        }

        return null;
    }

    public function index()
    {
        return view('movie/index', [
            'movies' => $this->movieModel
                ->orderBy('pid_movie', 'ASC')
                ->paginate(12),
            'pager' => $this->movieModel->pager
        ]);
    }

    public function show($id)
    {
        $db = \Config\Database::connect();

        $movie = $db->table('movie_movie_data')
            ->where('pid_movie', $id)
            ->where('deleted_at', null)
            ->get()
            ->getRow();

        if (!$movie) {
            return redirect()->to(site_url('movies'))->with('error', 'Film nebyl nalezen.');
        }

        $genres = $db->table('movie_has_genre_data')
            ->select('movie_genre.name')
            ->join('movie_genre', 'movie_genre.pid_genre = movie_has_genre_data.genre_pid_movie', 'left')
            ->where('movie_has_genre_data.movie_pid_movie', $id)
            ->get()
            ->getResult();

        $actors = $db->table('movie_movie_has_actor_1')
            ->select('movie_actor_data.name, movie_actor_data.surname, movie_movie_has_actor_1.role_name')
            ->join('movie_actor_data', 'movie_actor_data.pid_actor = movie_movie_has_actor_1.actor_id_actor', 'left')
            ->where('movie_movie_has_actor_1.movie_id_movie', $id)
            ->get()
            ->getResult();

        return view('movie/show', [
            'movie' => $movie,
            'genres' => $genres,
            'actors' => $actors
        ]);
    }

    public function showWithGenre($movieId, $genreId)
    {
        return $this->show($movieId);
    }

    public function addForm()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $db = \Config\Database::connect();

        return view('movie/addForm', [
            'genres' => $db->table('movie_genre')->get()->getResult()
        ]);
    }

    public function add()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $movieId = $this->movieModel->insert([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'release_date' => $this->request->getPost('release_date'),
            'duration' => $this->request->getPost('duration'),
            'rating' => $this->request->getPost('rating'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ]);

        $genreId = $this->request->getPost('genre_id');

        if ($genreId) {
            $db = \Config\Database::connect();

            $db->table('movie_has_genre_data')->insert([
                'movie_pid_movie' => $movieId,
                'genre_pid_movie' => $genreId
            ]);
        }

        return redirect()->to(site_url('movies'))->with('success', 'Film byl přidán.');
    }

    public function editForm($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $movie = $this->movieModel->find($id);

        if (!$movie) {
            return redirect()->to(site_url('movies'))->with('error', 'Film nebyl nalezen.');
        }

        $db = \Config\Database::connect();

        return view('movie/editForm', [
            'movie' => $movie,
            'genres' => $db->table('movie_genre')->get()->getResult()
        ]);
    }

    public function edit($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $this->movieModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'release_date' => $this->request->getPost('release_date'),
            'duration' => $this->request->getPost('duration'),
            'rating' => $this->request->getPost('rating'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $genreId = $this->request->getPost('genre_id');

        if ($genreId) {
            $db = \Config\Database::connect();

            $oldRelation = $db->table('movie_has_genre_data')
                ->where('movie_pid_movie', $id)
                ->get()
                ->getRow();

            if ($oldRelation) {
                $db->table('movie_has_genre_data')
                    ->where('pid_movie_has_genre', $oldRelation->pid_movie_has_genre)
                    ->update(['genre_pid_movie' => $genreId]);
            } else {
                $db->table('movie_has_genre_data')->insert([
                    'movie_pid_movie' => $id,
                    'genre_pid_movie' => $genreId
                ]);
            }
        }

        return redirect()->to(site_url('movies'))->with('success', 'Film byl upraven.');
    }

    public function remove($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $this->movieModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(site_url('movies'))->with('success', 'Film byl smazán.');
    }

    public function statistics()
    {
        $db = \Config\Database::connect();

        $totalMovies = $db->table('movie_movie_data')
            ->where('deleted_at', null)
            ->countAllResults();

        $averageRating = $db->table('movie_movie_data')
            ->selectAvg('rating', 'average_rating')
            ->where('deleted_at', null)
            ->get()
            ->getRow();

        return view('movie/statistics', [
            'totalMovies' => $totalMovies,
            'averageRating' => $averageRating
        ]);
    }
}