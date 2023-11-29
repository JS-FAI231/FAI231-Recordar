<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('layouts.app');
// });


Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/', App\Http\Controllers\MainController::class)->names('main');
Route::resource('/home', App\Http\Controllers\MainController::class)->names('main');
Route::resource('/main', App\Http\Controllers\MainController::class)->names('main');

Route::resource('users', App\Http\Controllers\UserController::class)->names('users');
Route::resource('roles', App\Http\Controllers\RoleController::class)->names('roles');
Route::resource('permissions', App\Http\Controllers\PermissionController::class)->names('permissions');

Route::resource('styles', App\Http\Controllers\StyleController::class)->names('styles');
Route::resource('genders', App\Http\Controllers\GenderController::class)->names('genders');
Route::resource('countries', App\Http\Controllers\CountryController::class)->names('countries');
Route::post('getCountries', 'App\Http\Controllers\CountryController@getCountries')->name('getCountries');

Route::resource('formats', App\Http\Controllers\FormatController::class)->names('formats');
Route::resource('tracks', App\Http\Controllers\TrackController::class)->names('tracks');
Route::resource('images', App\Http\Controllers\ImageController::class)->names('images');

Route::resource('titles', App\Http\Controllers\TitleController::class)->names('titles');

Route::resource('folders', App\Http\Controllers\FolderController::class)->names('folders')->middleware(['auth']);
Route::resource('wishes', App\Http\Controllers\WishController::class)->names('wishes')->middleware(['auth']);


Route::resource('submissions', App\Http\Controllers\SubmissionController::class)->names('submissions')->middleware(['auth']);

Route::resource('demands', App\Http\Controllers\DemandController::class)->names('demands')->middleware(['auth']);
Route::post('addMessageResponse', 'App\Http\Controllers\DemandController@addMessageResponse')->name('addMessageResponse')->middleware(['auth']);


Route::resource('visits', App\Http\Controllers\VisitController::class)->names('visits');

Route::resource('activitylogs', App\Http\Controllers\ActivityLogController::class)->names('activitylogs')->middleware(['auth']);

Route::post('addtowish', 'App\Http\Controllers\TitleController@addtowish')->name('addtowish');
Route::post('removefromwish', 'App\Http\Controllers\TitleController@removefromwish')->name('removefromwish');
Route::post('setFolder', 'App\Http\Controllers\TitleController@setFolder')->name('setFolder');


Route::post('rateTitle', 'App\Http\Controllers\TitleController@rateTitle')->name('rateTitle');
Route::post('rateUserSubmission', 'App\Http\Controllers\DemandController@rateUserSubmission')->name('rateUserSubmission');


Route::get('searchDeezerApi', 'App\Http\Controllers\TitleController@searchDeezerApi')->name('searchDeezerApi');
Route::get('titleDeezerApi/{titleid}', 'App\Http\Controllers\TitleController@titleDeezerApi')->name('titleDeezerApi');

Route::get('searchSoapLyrics', 'App\Http\Controllers\TitleController@searchSoapLyrics')->name('searchSoapLyrics');
Route::get('textSoapLyrics/{id}/{chks}', 'App\Http\Controllers\TitleController@textSoapLyrics')->name('textSoapLyrics');

Route::get('searchSpotifyApi', 'App\Http\Controllers\TitleController@searchSpotifyApi')->name('searchSpotifyApi');


