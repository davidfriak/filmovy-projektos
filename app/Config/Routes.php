<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'HomeController::index');

$routes->get('login', 'AuthController::loginForm');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('movies', 'MovieController::index');
$routes->get('movies/show/(:num)', 'MovieController::show/$1');
$routes->get('movies/statistics', 'MovieController::statistics');

$routes->get('movies/addForm', 'MovieController::addForm');
$routes->post('movies/add', 'MovieController::add');

$routes->get('movies/editForm/(:num)', 'MovieController::editForm/$1');
$routes->post('movies/edit/(:num)', 'MovieController::edit/$1');

$routes->post('movies/remove/(:num)', 'MovieController::remove/$1');

$routes->get('movies/show/(:num)/genre/(:num)', 'MovieController::showWithGenre/$1/$2');

$routes->get('popular', 'PopularMovieController::index');
$routes->get('popular/addForm', 'PopularMovieController::addForm');
$routes->post('popular/add', 'PopularMovieController::add');
$routes->post('popular/remove/(:num)', 'PopularMovieController::remove/$1');