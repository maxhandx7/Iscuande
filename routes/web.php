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
Route::get('/', 'WebController@index');

Route::get('nosotros/', 'WebController@index');
Route::get('medicos/', 'WebController@index');
Route::get('contactos/', 'WebController@index');

Route::resource('users', 'UserController')->names('users');
Route::resource('especialidads', 'EspecialidadController')->names('especialidads');
Route::resource('citas', 'CitaController')->names('citas'); 
Route::resource('turnos', 'TurnoController')->names('turnos');
Route::resource('categories', 'CategoryController')->names('categories');
Route::resource('posts', 'PostController')->names('posts');
Route::resource('tags', 'TagController')->names('tags');
Route::resource('configs', 'ConfigController')->names('configs');


Route::post('storeCita', 'CitaController@storeCita')->name('storeCita');
Route::post('update_status', 'AjaxController@updateStatus')->name('update_status');

Route::get('change_status/posts/{post}', 'PostController@change_status')->name('change.status.posts');
Route::get('get_turnos', 'AjaxController@getTurnos')->name('get_turnos');
Route::get('filter_fecha', 'CitaController@index')->name('filter_fecha');
Route::get('blog/', 'BlogController@blog')->name('blog');
Route::get('post/{slug}', 'BlogController@post')->name('post');
Route::get('category/{slug}','BlogController@category')->name('category');
Route::get('etiquetas/{slug}','BlogController@tag')->name('tag');




Auth::routes();

Route::group(['middleware' => 'user.status'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
});




