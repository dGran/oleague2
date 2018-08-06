<?php

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

// Authenticate routes
Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser')->name('verifyUser');
Route::get('/user/resend_verify', 'Auth\LoginController@resendActivation')->name('resendActivation');
Route::post('/user/resend_verify', 'Auth\LoginController@resendActivationMail')->name('resendActivation.mail');
// Route::get('/user/resend_verify/{token}', 'Auth\LoginController@resendActivationMail')->name('resendActivationMail');

// Home Routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('participantes', 'HomeController@participants')->name('participants');
Route::get('competiciones', 'HomeController@competitions')->name('competitions');
Route::get('competiciones/competicion', 'HomeController@competition')->name('competition');
Route::get('competiciones/competicion/clasificacion', 'HomeController@competition_standing')->name('competition.league.standing');
Route::get('competiciones/competicion/calendario', 'HomeController@competition_schedule')->name('competition.league.schedule');
Route::get('competiciones/competicion/estadisticas', 'HomeController@competition_statistics')->name('competition.league.statistics');
Route::get('competiciones/competicion/partido', 'HomeController@competition_match')->name('competition.match');

// User routes
Route::get('perfil', 'ProfileController@edit')->name('profileEdit');
Route::put('perfil/{id}', 'ProfileController@update')->name('profileUpdate');

// Admin Routes
Route::middleware('auth', 'role:admin')->group(function () {

	Route::get('/admin', 'AdminController@dashboard')->name('admin')->middleware('auth', 'role:admin');

	Route::get('/admin/configuracion_general', 'AdminController@generalSettings')->name('admin.general_settings');

	//Teams
	Route::get('/admin/equipos', 'TeamController@index')->name('admin.teams');
	Route::get('/admin/equipos/nuevo', 'TeamController@add')->name('admin.teams.add');
	Route::post('/admin/equipos/nuevo', 'TeamController@save')->name('admin.teams.save');
	Route::get('/admin/equipos/duplicar/{id}', 'TeamController@duplicate')->name('admin.teams.duplicate');
	Route::delete('/admin/equipos/eliminar/{id}', 'TeamController@destroy')->name('admin.teams.destroy');
	Route::get('/admin/equipos/duplicar-seleccionados/{ids}', 'TeamController@duplicateMany')->name('admin.teams.duplicate.many');
	Route::get('/admin/equipos/eliminar-seleccionados/{ids}', 'TeamController@destroyMany')->name('admin.teams.destroy.many');
	Route::post('/admin/equipos/importar', 'TeamController@importFile')->name('admin.teams.import.file');
	Route::get('/admin/equipos/exportar/{type}/{filterCategory?}/{filterName?}', 'TeamController@exportFile')->name('admin.teams.export.file');
});
