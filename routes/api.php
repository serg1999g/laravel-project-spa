<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\LogoutController;

use Modules\User\Http\Controllers\UserController;
use Modules\Mission\Http\Controllers\MissionController;
use Modules\Image\Http\Controllers\ImageController;

/** @var  \Illuminate\Routing\Router $router */
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$router->group(['middleware' => ['auth:api']], function (Router $router) {
    $router->post('logout', [LogoutController::class, 'logout']);

    $router->group(['prefix' => 'user'], function (Router $router) {
        $router->get('auth-user', [UserController::class,'AuthUser']);
        $router->get('{id}/show', [UserController::class, 'show']);
        $router->get('/', [UserController::class, 'index']);
    });

    $router->group(['prefix' => 'mission'], function (Router $router) {
        $router->post('create', [MissionController::class, 'create']);
        $router->get('/', [MissionController::class, 'index']);
        $router->put('{id}/update', [MissionController::class, 'update']);
        $router->delete('{id}/destroy', [MissionController::class, 'destroy']);
        $router->get('{id}/edit', [MissionController::class, 'edit']);
        $router->get('{id}/show', [MissionController::class, 'show']);
    });

    $router->delete('image/{id}/delete', [ImageController::class, 'delete']);
});


$router->post('register', [RegisterController::class, 'register']);
$router->post('login', [LoginController::class, 'login']);
