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
        Route::get('/valider/{id}', 'Maintenance\Reception\ReceptionsController@valider')->name('reception_valider');
        Route::get('/imprimer/{id}', 'Maintenance\Reception\ReceptionsController@print')->name('reception_print');
        //with js
        Route::get('/delete/{id}', 'Maintenance\Reception\ReceptionsController@delete');
        Route::get('/force/delete/{id}', 'Maintenance\Reception\ReceptionsController@forceDelete');
    });

    Route::prefix('diagnostique')->group(function () {
        Route::get('/index', 'Maintenance\Diagnostique\DiagnostiquesController@index')->name('diagnostiques');
        Route::get('/liste', 'Maintenance\Diagnostique\DiagnostiquesController@liste')->name('diagnostique_liste');
        Route::get('/add', 'Maintenance\Diagnostique\DiagnostiquesController@add')->name('diagnostique_add');
        Route::get('/edit/{id}', 'Maintenance\Diagnostique\DiagnostiquesController@edit')->name('diagnostique_edit');
        Route::get('/show/{id}', 'Maintenance\Diagnostique\DiagnostiquesController@show')->name('diagnostique_show');
        Route::post('/store', 'Maintenance\Diagnostique\DiagnostiquesController@store')->name('diagnostique_store');
        Route::post('/update', 'Maintenance\Diagnostique\DiagnostiquesController@update')->name('diagnostique_update');
        Route::get('/delete/{id}', 'Maintenance\Diagnostique\DiagnostiquesController@delete')->name('diagnostique_delete');
    });

    Route::prefix('essai')->group(function () {
        Route::prefix('pre')->group(function () {
            Route::get('/liste', 'Maintenance\Essai\PreessaisController@liste')->name('preessai_liste');
            Route::get('/add', 'Maintenance\Essai\PreessaisController@add')->name('preessai_add');
            Route::get('/edit/{id}', 'Maintenance\Essai\PreessaisController@edit')->name('preessai_edit');
            Route::post('/store', 'Maintenance\Essai\PreessaisController@store')->name('preessai_store');
            Route::post('/update', 'Maintenance\Essai\PreessaisController@update')->name('preessai_update');
        });
        Route::prefix('post')->group(function () {
            Route::get('/liste', 'Maintenance\Essai\EssaisController@liste')->name('postessai_liste');
            Route::get('/add', 'Maintenance\Essai\EssaisController@add')->name('postessai_add');
            Route::get('/edit/{id}', 'Maintenance\Essai\EssaisController@edit')->name('postessai_edit');
            Route::get('/show/{id}', 'Maintenance\Essai\EssaisController@show')->name('postessai_show');
            Route::post('/store', 'Maintenance\Essai\EssaisController@store')->name('postessai_store');
            Route::post('/update', 'Maintenance\Essai\EssaisController@update')->name('postessai_update');
        });

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
        Route::get('/index', 'Systeme\ComptesController@index')->name('comptes');
        Route::get('/add', 'Systeme\ComptesController@add')->name('compte_add');
        Route::get('/edit/{id}', 'Systeme\ComptesController@edit')->name('compte_edit');
    });

    Route::prefix('types_reparation')->group(function () {
        Route::get('/index', 'Systeme\TypesReparationsController@index')->name('types_reparations');
        Route::get('/add', 'Systeme\TypesReparationsController@add')->name('types_reparation_add');
        Route::post('/store', 'Systeme\TypesReparationsController@store')->name('types_reparation_store');
        Route::get('/edit/{id}', 'Systeme\TypesReparationsController@edit')->name('types_reparation_edit');
        Route::post('/update', 'Systeme\TypesReparationsController@update')->name('types_reparation_update');
    });

    Route::prefix('async')->group(function () {
        Route::get('/personne/find/{contact}', 'PersonnesController@findjs');
        Route::post('/personne/store', 'PersonnesController@storejs');
    });

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
