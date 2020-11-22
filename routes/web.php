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
Auth::routes();
Route::get('/', 'DashboardController@index')->name('acceuil');
Route::prefix('maintenance')->group(function () {
    Route::get('/index', 'DashboardController@maintenance')->name('maintenance_index');

    Route::prefix('reception')->group(function () {
        Route::get('/index', 'Maintenance\Reception\ReceptionsController@index')->name('receptions');
        Route::get('/liste', 'Maintenance\Reception\ReceptionsController@liste')->name('reception_liste');
        Route::get('/add', 'Maintenance\Reception\ReceptionsController@add')->name('reception_add');
        Route::get('/edit/{id}', 'Maintenance\Reception\ReceptionsController@edit')->name('reception_edit');
        Route::get('/show/{id}', 'Maintenance\Reception\ReceptionsController@show')->name('reception_show');
        Route::post('/store', 'Maintenance\Reception\ReceptionsController@store')->name('reception_store');
        Route::post('/update', 'Maintenance\Reception\ReceptionsController@update')->name('reception_update');
    });

    Route::prefix('diagnostique')->group(function () {
        Route::get('/index', 'Maintenance\Diagnostique\DiagnostiquesController@index')->name('diagnostiques');
        Route::get('/liste', 'Maintenance\Diagnostique\DiagnostiquesController@liste')->name('diagnostique_liste');
        Route::get('/add', 'Maintenance\Diagnostique\DiagnostiquesController@add')->name('diagnostique_add');
        Route::get('/edit/{id}', 'Maintenance\Diagnostique\DiagnostiquesController@edit')->name('diagnostique_edit');
        Route::get('/show/{id}', 'Maintenance\Diagnostique\DiagnostiquesController@show')->name('diagnostique_show');
        Route::post('/store', 'Maintenance\Diagnostique\DiagnostiquesController@store')->name('diagnostique_store');
        Route::post('/update', 'Maintenance\Diagnostique\DiagnostiquesController@update')->name('diagnostique_update');
    });

    Route::prefix('essai')->group(function () {
        Route::get('/index', 'Maintenance\Essai\EssaisController@index')->name('essais');
        Route::get('/liste', 'Maintenance\Essai\EssaisController@liste')->name('essai_liste');
        Route::get('/add', 'Maintenance\Essai\EssaisController@add')->name('essai_add');
        Route::get('/edit/{id}', 'Maintenance\Essai\EssaisController@edit')->name('essai_edit');
        Route::get('/show/{id}', 'Maintenance\Essai\EssaisController@show')->name('essai_show');
        Route::post('/store', 'Maintenance\Essai\EssaisController@store')->name('essai_store');
        Route::post('/update', 'Maintenance\Essai\EssaisController@update')->name('essai_update');
    });

    Route::prefix('reparation')->group(function () {
        Route::get('/index', 'Maintenance\Reparation\ReparationsController@index')->name('reparations');
        Route::get('/liste', 'Maintenance\Reparation\ReparationsController@liste')->name('reparation_liste');
        Route::get('/add', 'Maintenance\Reparation\ReparationsController@add')->name('reparation_add');
        Route::get('/edit/{id}', 'Maintenance\Reparation\ReparationsController@edit')->name('reparation_edit');
        Route::get('/show/{id}', 'Maintenance\Reparation\ReparationsController@show')->name('reparation_show');
        Route::post('/store', 'Maintenance\Reparation\ReparationsController@store')->name('reparation_store');
        Route::post('/update', 'Maintenance\Reparation\ReparationsController@update')->name('reparation_update');
    });

    Route::prefix('hangars')->group(function () {
        Route::get('/index', 'Maintenance\Reception\HangarsController@index')->name('hangars');
        Route::get('/add', 'Maintenance\Reception\HangarsController@add')->name('hangar_add');
        Route::get('/edit/{id}', 'Maintenance\Reception\HangarsController@edit')->name('hangar_edit');
        Route::get('/show/{id}', 'Maintenance\Reception\HangarsController@show')->name('hangar_show');
        Route::post('/store', 'Maintenance\Reception\HangarsController@store')->name('hangar_store');
        Route::post('/update', 'Maintenance\Reception\HangarsController@update')->name('hangar_update');
    });

});

Route::prefix('systeme')->group(function () {
    Route::get('/index', 'DashboardController@systeme')->name('systeme_index');
    Route::prefix('comptes')->group(function () {
        Route::get('/index', 'Maintenance\Essai\EssaisController@index')->name('essais');
        Route::get('/liste', 'Maintenance\Essai\EssaisController@liste')->name('essai_liste');
        Route::get('/add', 'Maintenance\Essai\EssaisController@add')->name('essai_add');

    });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
