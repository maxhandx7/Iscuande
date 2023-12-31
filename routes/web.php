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

Route::get('nosotros/', 'WebController@nosotros');
Route::get('medicos/', 'WebController@medicos');
Route::get('contactos/', 'WebController@contactos');

Route::resource('citas', 'CitaController')->names('citas'); 
Route::middleware(['can:admin-only'])->group(function () {
Route::resource('users', 'UserController')->names('users');
Route::resource('especialidads', 'EspecialidadController')->names('especialidads');
Route::resource('turnos', 'TurnoController')->names('turnos');
Route::resource('categories', 'CategoryController')->names('categories');
Route::resource('posts', 'PostController')->names('posts');
Route::resource('tags', 'TagController')->names('tags');
Route::resource('business', 'BusinessController')->names('business')->only([
    'index', 'update'
]);
Route::resource('assistants', 'AssistantController')->names('assistants');
});
Route::resource('configs', 'ConfigController')->names('configs');
Route::post('storeCita', 'CitaController@storeCita')->name('storeCita');
Route::post('update_status', 'AjaxController@updateStatus')->name('update_status');
Route::post('contacts', 'WebController@store')->name('contacts');
Route::post('/posts/{post_id}/comments', 'CommentController@store')->name('comments.store');
Route::post('cambiarContrasena', 'ConfigController@updatePassword')->name('update_password');
Route::post('exportar.user', 'ReportController@exportUser')->name('exportar.user');
Route::post('exportar.turno', 'ReportController@exportTurno')->name('exportar.turno');
Route::post('exportar.cita', 'ReportController@exportCita')->name('exportar.cita');

Route::get('change_status/posts/{post}', 'PostController@change_status')->name('change.status.posts');
Route::get('get_turnos', 'AjaxController@getTurnos')->name('get_turnos');
Route::get('get_paciente', 'AjaxController@getPacientes')->name('get_paciente');
Route::get('get_horarios', 'AjaxController@getHorario')->name('get_horarios');
Route::get('send_email', 'CitaController@enviarCorreo')->name('send_email');
Route::get('filter_fecha', 'CitaController@index')->name('filter_fecha');
Route::get('blog/', 'BlogController@blog')->name('blog');
Route::get('post/{slug}', 'BlogController@post')->name('post');
Route::get('category/{slug}','BlogController@category')->name('category');
Route::get('etiquetas/{slug}','BlogController@tag')->name('tag');
Route::get('/cambiar-contrasena', 'UserController@showChangePasswordForm')->name('password.change');
Route::get('createAdmin', 'CitaController@createAdmin')->name('createAdmin');
Route::get('reports', 'ReportController@index')->name('reports');
Route::get('reports/user', 'ReportController@user')->name('reports.user');
Route::get('reports/turno', 'ReportController@turno')->name('reports.turno');
Route::get('reports/cita', 'ReportController@cita')->name('reports.cita');
Route::get('/search', 'SearchController@show')->name('search');
Route::get('/comments', 'CommentController@index')->name('comments.index');


Route::delete('/comments/{id}', 'CommentController@destroy')->name('comments.destroy');


Auth::routes();

Route::group(['middleware' => 'user.status'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
});

Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');




