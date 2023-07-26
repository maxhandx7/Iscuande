<?php

use Illuminate\Support\Facades\Auth;
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

Route::resource('users', 'UserController')->names('users');
Route::resource('medicos', 'MedicoController')->names('medicos');
Route::resource('citas', 'CitaController')->names('citas');
Route::resource('cupos', 'CupoController')->names('cupos');

Auth::routes();

Route::group(['middleware' => 'user.status'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
});


