<?php

declare(strict_types=1);

use App\Router;
use Controller\AdController;
use Controller\UserController;

Router::get('/', fn() => loadController('home'));

Router::get('/ads/{id}', fn(int $id) => (new AdController())->show($id));
Router::get('/ads/index', fn() => (new \Controller\UserController())->allAds());
Router::get('/ads/create', fn() => loadView('dashboard/create-ad', loadFromPublic: false));
Router::post('/ads/create', fn() => (new AdController())->create());

Router::get('/ads/update/{id}', fn(int $id) => (new AdController())->update($id));

// Statuses
Router::get('/status/create', fn() => loadView('dashboard/create-status', loadFromPublic: false));
Router::post('/status/create', fn() => loadController('createStatus'));

Router::get('/login', fn() => loadView('auth/login', loadFromPublic: false), 'guest');
Router::post('/login', fn() => (new \Controller\AuthController())->login());

Router::get('/logout', fn() => (new UserController())->logout());

Router::get('/search', fn() => (new AdController())->search());

Router::get('/admin', fn() => loadView('dashboard/home', loadFromPublic: false), 'auth');
Router::get('/branches', fn() => (new \Controller\UserController())->branches());
Router::get('/branch/create', fn() => (new \Controller\BranchController())->createBranch());
Router::get('/profile2', fn() => (new \Controller\UserController())->loadProfile(), 'auth');

Router::errorResponse(404, 'Not Found');
