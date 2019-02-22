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
	Route::get('/admin/logs/exportar/{filename}/{type}/{filterDescription}/{filterUser}/{filterTable}/{filterType}/{order}/{ids?}', 'AdminController@exportFile')->name('admin.export.file');
	Route::post('/admin/logs/importar', 'AdminController@importFile')->name('admin.import.file');

	Route::get('/admin/configuracion_general', 'AdminController@generalSettings')->name('admin.general_settings');

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

	//Players Databases
	Route::get('/admin/databases_jugadores', 'PlayerDBController@index')->name('admin.players_dbs');
	Route::get('/admin/databases_jugadores/nuevo', 'PlayerDBController@add')->name('admin.players_dbs.add');
	Route::post('/admin/databases_jugadores/nuevo', 'PlayerDBController@save')->name('admin.players_dbs.save');
	Route::get('/admin/databases_jugadores/{id}', 'PlayerDBController@edit')->name('admin.players_dbs.edit');
	Route::put('/admin/databases_jugadores/{id}', 'PlayerDBController@update')->name('admin.players_dbs.update');
	Route::delete('/admin/databases_jugadores/eliminar/{id}', 'PlayerDBController@destroy')->name('admin.players_dbs.destroy');
	Route::get('/admin/databases_jugadores/eliminar-seleccionados/{ids}', 'PlayerDBController@destroyMany')->name('admin.players_dbs.destroy.many');
	Route::get('/admin/databases_jugadores/duplicar/{id}', 'PlayerDBController@duplicate')->name('admin.players_dbs.duplicate');
	Route::get('/admin/databases_jugadores/duplicar-seleccionados/{ids}', 'PlayerDBController@duplicateMany')->name('admin.players_dbs.duplicate.many');
	Route::get('/admin/databases_jugadores/exportar/{filename}/{type}/{filterName}/{order}/{ids?}', 'PlayerDBController@exportFile')->name('admin.players_dbs.export.file');
	Route::post('/admin/databases_jugadores/importar', 'PlayerDBController@importFile')->name('admin.players_dbs.import.file');

	// Players
	Route::get('/admin/jugadores', 'PlayerController@index')->name('admin.players');
	Route::get('/admin/jugadores/nuevo', 'PlayerController@add')->name('admin.players.add');
	Route::post('/admin/jugadores/nuevo', 'PlayerController@save')->name('admin.players.save');
	Route::get('/admin/jugadores/{id}', 'PlayerController@edit')->name('admin.players.edit');
	Route::put('/admin/jugadores/{id}', 'PlayerController@update')->name('admin.players.update');
	Route::delete('/admin/jugadores/eliminar/{id}', 'PlayerController@destroy')->name('admin.players.destroy');
	Route::get('/admin/jugadores/eliminar-seleccionados/{ids}', 'PlayerController@destroyMany')->name('admin.players.destroy.many');
	Route::get('/admin/jugadores/ver/{id}', 'PlayerController@view')->name('admin.players.view');
	Route::get('/admin/jugadores/duplicar/{id}', 'PlayerController@duplicate')->name('admin.players.duplicate');
	Route::get('/admin/jugadores/duplicar-seleccionados/{ids}', 'PlayerController@duplicateMany')->name('admin.players.duplicate.many');
	Route::get('/admin/jugadores/exportar/{filename}/{type}/{filterName}/{filterCategory}/{filterTeam}/{filterNation}/{filterPosition}/{order}/{ids?}', 'PlayerController@exportFile')->name('admin.players.export.file');
	Route::get('/admin/jugadores/acciones/importar', 'PlayerController@importData')->name('admin.players.import.data');
	Route::post('/admin/jugadores/acciones/importar', 'PlayerController@importDataSave')->name('admin.players.import.data.save');
	Route::get('/admin/jugadores/acciones/enlazar_imagenes/{www}', 'PlayerController@linkWebImages')->name('admin.players.link_web_images');
	Route::get('/admin/jugadores/acciones/desenlazar_imagenes', 'PlayerController@unlinkWebImages')->name('admin.players.unlink_web_images');

	// Seasons
	Route::get('/admin/temporadas', 'SeasonController@index')->name('admin.seasons');
	Route::get('/admin/temporadas/nuevo', 'SeasonController@add')->name('admin.seasons.add');
	Route::post('/admin/temporadas/nuevo', 'SeasonController@save')->name('admin.seasons.save');
	Route::get('/admin/temporadas/{id}', 'SeasonController@edit')->name('admin.seasons.edit');
	Route::put('/admin/temporadas/{id}', 'SeasonController@update')->name('admin.seasons.update');
	Route::delete('/admin/temporadas/eliminar/{id}', 'SeasonController@destroy')->name('admin.seasons.destroy');
	Route::get('/admin/temporadas/eliminar-seleccionados/{ids}', 'SeasonController@destroyMany')->name('admin.seasons.destroy.many');
	Route::get('/admin/temporadas/duplicar/{id}', 'SeasonController@duplicate')->name('admin.seasons.duplicate');
	Route::get('/admin/temporadas/duplicar-seleccionados/{ids}', 'SeasonController@duplicateMany')->name('admin.seasons.duplicate.many');
	Route::get('/admin/temporadas/exportar/{filename}/{type}/{filterName}/{order}/{ids?}', 'SeasonController@exportFile')->name('admin.seasons.export.file');
	Route::post('/admin/temporadas/importar', 'SeasonController@importFile')->name('admin.seasons.import.file');

	// Season Participants
	Route::get('/admin/participantes', 'SeasonParticipantController@index')->name('admin.season_participants');
	Route::get('/admin/participantes/nuevo', 'SeasonParticipantController@add')->name('admin.season_participants.add');
	Route::post('/admin/participantes/nuevo', 'SeasonParticipantController@save')->name('admin.season_participants.save');
	Route::get('/admin/participantes/{id}', 'SeasonParticipantController@edit')->name('admin.season_participants.edit');
	Route::put('/admin/participantes/{id}', 'SeasonParticipantController@update')->name('admin.season_participants.update');
	Route::get('/admin/participantes/expulsar/{id}', 'SeasonParticipantController@kickout')->name('admin.season_participants.kickout');
	Route::delete('/admin/participantes/eliminar/{id}', 'SeasonParticipantController@destroy')->name('admin.season_participants.destroy');
	Route::get('/admin/participantes/eliminar-seleccionados/{ids}', 'SeasonParticipantController@destroyMany')->name('admin.season_participants.destroy.many');
	Route::get('/admin/participantes/exportar/{filename}/{type}/{filterSeason}/{order}/{ids?}', 'SeasonParticipantController@exportFile')->name('admin.season_participants.export.file');
	Route::post('/admin/participantes/importar', 'SeasonParticipantController@importFile')->name('admin.season_participants.import.file');

	// Season Players
	Route::get('/admin/temporada-jugadores', 'SeasonPlayerController@index')->name('admin.season_players');
	Route::get('/admin/temporada-jugadores/importar_test', 'SeasonPlayerController@import_full_roster')->name('admin.season_players.import_test');

	Route::get('/admin/temporada-jugadores/jugadores/nuevo', 'SeasonPlayerController@add')->name('admin.season_players.add');
	Route::post('/admin/temporada-jugadores/jugadores/nuevo', 'SeasonPlayerController@save')->name('admin.season_players.save');
	Route::get('/admin/temporada-jugadores/jugadores/{id}', 'SeasonPlayerController@edit')->name('admin.season_players.edit');
	Route::put('/admin/temporada-jugadores/jugadores/{id}', 'SeasonPlayerController@update')->name('admin.season_players.update');
	Route::delete('/admin/temporada-jugadores/jugadores/eliminar/{id}', 'SeasonPlayerController@destroy')->name('admin.season_players.destroy');
	Route::get('/admin/temporada-jugadores/jugadores/eliminar-seleccionados/{ids}', 'SeasonPlayerController@destroyMany')->name('admin.season_players.destroy.many');
	Route::get('/admin/temporada-jugadores/jugadores/exportar/{filename}/{type}/{filterSeason}/{order}/{ids?}', 'SeasonPlayerController@exportFile')->name('admin.season_players.export.file');
	Route::post('/admin/temporada-jugadores/jugadores/importar', 'SeasonPlayerController@importFile')->name('admin.season_players.import.file');
});
