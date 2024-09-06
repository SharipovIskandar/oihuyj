<?php

declare(strict_types=1);

use App\Router;
use Controller\AdController;

Router::get('/', fn() => loadController('home'));

Router::get('/ads/{id}', fn(int $id) => (new AdController())->show($id));
Router::get('/ads/create', fn() => loadView('dashboard/allAds'));
Router::post('/ads/create', fn() => (new AdController())->create());

Router::get('/ads/update/{id}', fn(int $id) => (new AdController())->update($id));

// Statuses
Router::get('/status/create', fn() => loadView('dashboard/create-status'));
Router::post('/status/create', fn() => loadController('createStatus'));

Router::get('/login', fn() => loadView('auth/login'), 'guest');
Router::post('/login', fn() => (new \Controller\AuthController())->login());

Router::get('/admin', fn() => loadView('dashboard/home'));
Router::get('/branches', fn() => (new \Controller\UserController())->branches());
Router::get('/profile2', fn() => (new \Controller\UserController())->loadProfile(), 'auth');

Router::errorResponse(404, 'Not Found');
