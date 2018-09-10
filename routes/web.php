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

	Route::get('/admin', 'AdminController@dashboard')->name('admin');

	Route::get('/admin/configuracion_general', 'AdminController@generalSettings')->name('admin.general_settings');

	//Teams
	Route::get('/admin/equipos', 'TeamController@index')->name('admin.teams');
	Route::get('/admin/equipos/nuevo', 'TeamController@add')->name('admin.teams.add');
	Route::post('/admin/equipos/nuevo', 'TeamController@save')->name('admin.teams.save');
	Route::get('/admin/equipos/{id}', 'TeamController@edit')->name('admin.teams.edit');
	Route::put('/admin/equipos/{id}', 'TeamController@update')->name('admin.teams.update');
	Route::delete('/admin/equipos/eliminar/{id}', 'TeamController@destroy')->name('admin.teams.destroy');
	Route::get('/admin/equipos/eliminar-seleccionados/{ids}', 'TeamController@destroyMany')->name('admin.teams.destroy.many');
	Route::get('/admin/equipos/ver/{id}', 'TeamController@view')->name('admin.teams.view');
	Route::get('/admin/equipos/duplicar/{id}', 'TeamController@duplicate')->name('admin.teams.duplicate');
	Route::get('/admin/equipos/duplicar-seleccionados/{ids}', 'TeamController@duplicateMany')->name('admin.teams.duplicate.many');
	Route::get('/admin/equipos/exportar/{filename}/{type}/{filterName}/{filterCategory}/{order}/{ids?}', 'TeamController@exportFile')->name('admin.teams.export.file');
	Route::post('/admin/equipos/importar', 'TeamController@importFile')->name('admin.teams.import.file');

	//Teams Categories
	Route::get('/admin/categorias_equipos', 'TeamCategoryController@index')->name('admin.teams_categories');
	Route::get('/admin/categorias_equipos/nuevo', 'TeamCategoryController@add')->name('admin.teams_categories.add');
	Route::post('/admin/categorias_equipos/nuevo', 'TeamCategoryController@save')->name('admin.teams_categories.save');
	Route::get('/admin/categorias_equipos/{id}', 'TeamCategoryController@edit')->name('admin.teams_categories.edit');
	Route::put('/admin/categorias_equipos/{id}', 'TeamCategoryController@update')->name('admin.teams_categories.update');
	Route::delete('/admin/categorias_equipos/eliminar/{id}', 'TeamCategoryController@destroy')->name('admin.teams_categories.destroy');
	Route::get('/admin/categorias_equipos/eliminar-seleccionados/{ids}', 'TeamCategoryController@destroyMany')->name('admin.teams_categories.destroy.many');
	Route::get('/admin/categorias_equipos/duplicar/{id}', 'TeamCategoryController@duplicate')->name('admin.teams_categories.duplicate');
	Route::get('/admin/categorias_equipos/duplicar-seleccionados/{ids}', 'TeamCategoryController@duplicateMany')->name('admin.teams_categories.duplicate.many');
	Route::get('/admin/categorias_equipos/exportar/{filename}/{type}/{filterName}/{order}/{ids?}', 'TeamCategoryController@exportFile')->name('admin.teams_categories.export.file');
	Route::post('/admin/categorias_equipos/importar', 'TeamCategoryController@importFile')->name('admin.teams_categories.import.file');
});
