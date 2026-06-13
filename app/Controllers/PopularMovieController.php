<?php

namespace App\Controllers;

use App\Libraries\MovieService;
use App\Models\PopularMovieModel;

class PopularMovieController extends BaseController
{
    protected PopularMovieModel $popularModel;
    protected MovieService $movieService;

    public function __construct()
    {
        $this->popularModel = new PopularMovieModel();
        $this->movieService = new MovieService();
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
        return view('popular/index', [
            'movies' => $this->popularModel->orderBy('pid_popular_movie', 'ASC')->paginate(config('Pager')->perPage),
            'pager' => $this->popularModel->pager,
            'movieService' => $this->movieService,
        ]);
    }

    public function addForm()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('popular/addForm');
    }

    public function add()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $poster = $this->movieService->uploadPoster($this->request->getFile('poster'));

        $ok = $this->popularModel->insert([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'release_date' => $this->movieService->dateToTimestamp($this->request->getPost('release_date')),
            'duration' => $this->request->getPost('duration'),
            'rating' => $this->request->getPost('rating'),
            'poster' => $poster ?: 'default.png',
        ]);

        return redirect()->to(site_url('popular'))->with($ok ? 'success' : 'error', $ok ? 'Populární film byl přidán.' : 'Populární film se nepodařilo přidat.');
    }

    public function remove($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $ok = $this->popularModel->delete($id);
        return redirect()->to(site_url('popular'))->with($ok ? 'success' : 'error', $ok ? 'Populární film byl smazán.' : 'Populární film se nepodařilo smazat.');
    }
}
