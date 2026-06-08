<?php

namespace App\Controllers;

use App\Models\MovieData;
use App\Models\Genre;
use App\Models\MovieHasGenreData;

class MovieController extends BaseController
{
    protected MovieData $movieModel;
    protected Genre $genreModel;
    protected MovieHasGenreData $movieHasGenreModel;

    public function __construct()
    {
        $this->movieModel = new MovieData();
        $this->genreModel = new Genre();
        $this->movieHasGenreModel = new MovieHasGenreData();
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
                ->orderBy('pid_movie', 'DESC')
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
            ->join(
                'movie_genre',
                'movie_genre.pid_genre = movie_has_genre_data.genre_pid_movie',
                'left'
            )
            ->where('movie_has_genre_data.movie_pid_movie', $id)
            ->get()
            ->getResult();

        $actors = $db->table('movie_movie_has_actor_1')
            ->select('movie_actor_data.name, movie_actor_data.surname, movie_movie_has_actor_1.role_name')
            ->join(
                'movie_actor_data',
                'movie_actor_data.pid_actor = movie_movie_has_actor_1.actor_id_actor',
                'left'
            )
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
        $db = \Config\Database::connect();

        $movie = $db->table('movie_movie_data')
            ->where('pid_movie', $movieId)
            ->where('deleted_at', null)
            ->get()
            ->getRow();

        if (!$movie) {
            return redirect()->to(site_url('movies'))->with('error', 'Film nebyl nalezen.');
        }

        $genres = $db->table('movie_has_genre_data')
            ->select('movie_genre.name')
            ->join(
                'movie_genre',
                'movie_genre.pid_genre = movie_has_genre_data.genre_pid_movie',
                'left'
            )
            ->where('movie_has_genre_data.movie_pid_movie', $movieId)
            ->where('movie_has_genre_data.genre_pid_movie', $genreId)
            ->get()
            ->getResult();

        $actors = $db->table('movie_movie_has_actor_1')
            ->select('movie_actor_data.name, movie_actor_data.surname, movie_movie_has_actor_1.role_name')
            ->join(
                'movie_actor_data',
                'movie_actor_data.pid_actor = movie_movie_has_actor_1.actor_id_actor',
                'left'
            )
            ->where('movie_movie_has_actor_1.movie_id_movie', $movieId)
            ->get()
            ->getResult();

        return view('movie/show', [
            'movie' => $movie,
            'genres' => $genres,
            'actors' => $actors
        ]);
    }

    public function addForm()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('movie/addForm', [
            'genres' => $this->genreModel->findAll()
        ]);
    }

    public function add()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $posterName = null;
        $poster = $this->request->getFile('poster');

        if ($poster && $poster->isValid() && !$poster->hasMoved()) {
            $posterName = $poster->getRandomName();
            $poster->move(FCPATH . 'uploads/posters', $posterName);
        }

        $movieId = $this->movieModel->insert([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'release_date' => $this->request->getPost('release_date'),
            'published_at' => $this->request->getPost('published_at'),
            'duration' => $this->request->getPost('duration'),
            'rating' => $this->request->getPost('rating'),
            'poster' => $posterName,
            'created_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ]);

        $genreId = $this->request->getPost('genre_id');

        if ($genreId) {
            $this->movieHasGenreModel->insert([
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

        return view('movie/editForm', [
            'movie' => $movie,
            'genres' => $this->genreModel->findAll()
        ]);
    }

    public function edit($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $movie = $this->movieModel->find($id);

        if (!$movie) {
            return redirect()->to(site_url('movies'))->with('error', 'Film nebyl nalezen.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'release_date' => $this->request->getPost('release_date'),
            'published_at' => $this->request->getPost('published_at'),
            'duration' => $this->request->getPost('duration'),
            'rating' => $this->request->getPost('rating'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $poster = $this->request->getFile('poster');

        if ($poster && $poster->isValid() && !$poster->hasMoved()) {
            $posterName = $poster->getRandomName();
            $poster->move(FCPATH . 'uploads/posters', $posterName);
            $data['poster'] = $posterName;
        }

        $this->movieModel->update($id, $data);

        $genreId = $this->request->getPost('genre_id');

        if ($genreId) {
            $oldRelation = $this->movieHasGenreModel
                ->where('movie_pid_movie', $id)
                ->first();

            if ($oldRelation) {
                $this->movieHasGenreModel->update($oldRelation->pid_movie_has_genre, [
                    'genre_pid_movie' => $genreId
                ]);
            } else {
                $this->movieHasGenreModel->insert([
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

        $movie = $this->movieModel->find($id);

        if (!$movie) {
            return redirect()->to(site_url('movies'))->with('error', 'Film nebyl nalezen.');
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