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
        Route::get('/index', 'Maintenance\ReceptionController@index')->name('receptions');
        Route::get('/add', 'Maintenance\ReceptionController@add')->name('reception_add');
        Route::get('/edit/{id}', 'Maintenance\ReceptionController@edit')->name('reception_edit');
        Route::get('/show/{id}', 'Maintenance\ReceptionController@show')->name('reception_show');
        Route::post('/store', 'Maintenance\ReceptionController@store')->name('reception_store');
        Route::post('/update', 'Maintenance\ReceptionController@update')->name('reception_update');
    });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
