<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$router->get('/laravel', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'cors','prefix' => 'apiv1'], function () use ($router) {
    $router->get('getProducts',  ['uses' => 'ProductController@getProducts']);
    // $router->get('getAccount/{id}', ['uses' => 'AccountController@getAccount']);
    // $router->post('createAccount', ['uses' => 'AccountController@createAccount']);
    // $router->post('updateAccount', ['uses' => 'AccountController@updateAccount']);
    // $router->get('deleteAccount/{id}', ['uses' => 'AccountController@deleteAccount']);
});
