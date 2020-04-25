<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\LogoutController;

use Modules\User\Http\Controllers\UserController;
use Modules\Mission\Http\Controllers\MissionController;

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

$router->middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$router->group(['middleware' => ['auth:api']], function (Router $router) {
    $router->post('logout', [LogoutController::class, 'logout']);
    $router->get('user/{id}/detail', [UserController::class, 'show']);
    $router->post('mission/create', [MissionController::class, 'create']);
    $router->get('mission', [MissionController::class, 'index']);
    $router->put('mission/{id}/update', [MissionController::class, 'update']);
    $router->delete('mission/{id}/destroy', [MissionController::class, 'destroy']);
    $router->get('mission/{id}/edit', [MissionController::class, 'edit']);
    $router->get('mission/{id}/show', [MissionController::class, 'show']);
});


$router->post('register', [RegisterController::class, 'register']);
$router->post('login', [LoginController::class, 'login']);
