<?php

use App\Http\Controllers;
use App\Http\Controllers\ProductController;
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

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

$prefix = "apiv1";

Route::get($prefix . '/getProducts', [ProductController::class, 'getProducts']);
Route::get($prefix . '/getProduct/{id}', [ProductController::class, 'getProduct']);

// $router->group(['middleware' => 'cors','prefix' => 'apiv1'], function () use ($router) {
//     $router->get('getAccounts',  ['uses' => 'AccountController@getAccounts']);
//     $router->get('getAccount/{id}', ['uses' => 'AccountController@getAccount']);
//     $router->post('createAccount', ['uses' => 'AccountController@createAccount']);
//     $router->post('updateAccount', ['uses' => 'AccountController@updateAccount']);
//     $router->get('deleteAccount/{id}', ['uses' => 'AccountController@deleteAccount']);
// });
