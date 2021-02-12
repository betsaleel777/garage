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
Route::get('/deconnexion', 'Auth\LoginController@logout')->name('deconnexion');
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
        Route::get('/delete/force/{id}', 'Maintenance\Reception\ReceptionsController@forceDelete');
    });

    Route::prefix('prediagnostique')->group(function () {
        Route::get('/index', 'Maintenance\Diagnostique\PrediagnostiquesController@index')->name('prediagnostiques');
        Route::get('/liste', 'Maintenance\Diagnostique\PrediagnostiquesController@liste')->name('prediagnostique_liste');
        Route::get('/edit/{id}', 'Maintenance\Diagnostique\PrediagnostiquesController@edit')->name('prediagnostique_edit');
        Route::post('/store', 'Maintenance\Diagnostique\PrediagnostiquesController@store')->name('prediagnostique_store');
        Route::post('/update', 'Maintenance\Diagnostique\PrediagnostiquesController@update')->name('prediagnostique_update');
        Route::get('/delete/{id}', 'Maintenance\Diagnostique\PrediagnostiquesController@delete')->name('prediagnostique_delete');
    });

    Route::prefix('diagnostique')->group(function () {
        Route::get('/index', 'Maintenance\Diagnostique\DiagnostiquesController@index')->name('diagnostiques');
        Route::get('/liste', 'Maintenance\Diagnostique\DiagnostiquesController@liste')->name('diagnostique_liste');
        Route::get('/complete/{reception}', 'Maintenance\Diagnostique\DiagnostiquesController@complete')->name('diagnostique_complete');
        Route::get('/show/{reception}', 'Maintenance\Diagnostique\DiagnostiquesController@show')->name('diagnostique_show');
        //with js
        Route::post('/fermer', 'Maintenance\Diagnostique\DiagnostiquesController@fermer');
    });

    Route::prefix('essai')->group(function () {
        Route::get('/index', 'Maintenance\Essai\EssaisController@index')->name('essais');
        Route::prefix('pre')->group(function () {
            Route::get('/liste', 'Maintenance\Essai\PreessaisController@liste')->name('preessai_liste');
            Route::get('/valider/{id}', 'Maintenance\Essai\PreessaisController@valider')->name('preessai_valider');
            Route::post('/store', 'Maintenance\Essai\PreessaisController@store')->name('preessai_store');
            Route::post('/update', 'Maintenance\Essai\PreessaisController@update')->name('preessai_update');
        });
        Route::prefix('post')->group(function () {
            Route::get('/liste', 'Maintenance\Essai\PostessaisController@liste')->name('postessai_liste');
            Route::post('/store', 'Maintenance\Essai\PostessaisController@store')->name('postessai_store');
            Route::post('/update', 'Maintenance\Essai\PostessaisController@update')->name('postessai_update');
            Route::get('/valider/{id}', 'Maintenance\Essai\PostessaisController@valider')->name('postessai_valider');
        });
    });

    Route::prefix('reparation')->group(function () {
        Route::get('/index', 'Maintenance\Reparation\ReparationsController@index')->name('reparations');
        Route::get('/liste', 'Maintenance\Reparation\ReparationsController@liste')->name('reparation_liste');
        Route::get('/complete/{reception}', 'Maintenance\Reparation\ReparationsController@complete')->name('reparation_complete');
        Route::get('/show/{reception}', 'Maintenance\Reparation\ReparationsController@show')->name('reparation_show');
        //with js
        Route::post('/fermer', 'Maintenance\Reparation\ReparationsController@fermer');
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

Route::prefix('stock')->group(function () {
    Route::get('index', 'DashboardController@stock')->name('stock_index');
    Route::prefix('piece')->group(function () {
        Route::get('liste', 'Stock\PiecesController@liste')->name('pieces');
        Route::get('/edit/{id}', 'Stock\PiecesController@edit')->name('piece_edit');
        Route::post('/update', 'Stock\PiecesController@update')->name('piece_update');
        Route::get('/show/{id}', 'Stock\PiecesController@show')->name('piece_show');
        Route::get('/delete/{id}', 'Stock\PiecesController@delete');
        Route::get('/delete/force/{id}', 'Stock\PiecesController@forceDelete');
        Route::get('add', 'Stock\PiecesController@add')->name('piece_add');
        Route::post('store', 'Stock\PiecesController@store')->name('piece_store');
    });
});

Route::prefix('systeme')->group(function () {
    Route::get('/index', 'DashboardController@systeme')->name('systeme_index');
    Route::prefix('comptes')->group(function () {
        Route::get('/index', 'Systeme\ComptesController@index')->name('comptes');
        Route::get('/add', 'Systeme\ComptesController@add')->name('compte_add');
        Route::get('/edit/{id}', 'Systeme\ComptesController@edit')->name('compte_edit');
    });

    Route::prefix('devises')->group(function () {
        Route::get('/index', 'Systeme\DevisesController@index')->name('devises');
        Route::get('/add', 'Systeme\DevisesController@add')->name('devise_add');
        Route::get('/edit/{id}', 'Systeme\DevisesController@edit')->name('devise_edit');
        Route::get('/set/{id}', 'Systeme\DevisesController@setCurrent')->name('devise_current');
        Route::post('/store', 'Systeme\DevisesController@store')->name('devise_store');
        Route::post('/update', 'Systeme\DevisesController@update')->name('devise_update');
    });

    Route::prefix('types_reparation')->group(function () {
        Route::get('/index', 'Systeme\TypesReparationsController@index')->name('types_reparations');
        Route::get('/add', 'Systeme\TypesReparationsController@add')->name('types_reparation_add');
        Route::post('/store', 'Systeme\TypesReparationsController@store')->name('types_reparation_store');
        Route::get('/edit/{id}', 'Systeme\TypesReparationsController@edit')->name('types_reparation_edit');
        Route::post('/update', 'Systeme\TypesReparationsController@update')->name('types_reparation_update');
    });

    Route::prefix('atelier')->group(function () {
        Route::get('/index', 'Systeme\AteliersController@index')->name('ateliers');
        Route::get('/add', 'Systeme\AteliersController@add')->name('atelier_add');
        Route::post('/store', 'Systeme\AteliersController@store')->name('atelier_store');
        Route::get('/edit/{id}', 'Systeme\AteliersController@edit')->name('atelier_edit');
        Route::post('/update', 'Systeme\AteliersController@update')->name('atelier_update');
    });

    Route::prefix('magasin')->group(function () {
        Route::get('/index', 'Systeme\Stock\MagasinsController@index')->name('magasins');
        Route::get('/add', 'Systeme\Stock\MagasinsController@add')->name('magasin_add');
        Route::post('/store', 'Systeme\Stock\MagasinsController@store')->name('magasin_store');
        Route::post('/storejs', 'Systeme\Stock\MagasinsController@storejs')->name('magasin_storejs');
        Route::get('/edit/{id}', 'Systeme\Stock\MagasinsController@edit')->name('magasin_edit');
        Route::post('/update', 'Systeme\Stock\MagasinsController@update')->name('magasin_update');
    });

    Route::prefix('fabricant')->group(function () {
        Route::get('/index', 'Systeme\Stock\FabricantsController@index')->name('fabricants');
        Route::get('/add', 'Systeme\Stock\FabricantsController@add')->name('fabricant_add');
        Route::post('/store', 'Systeme\Stock\FabricantsController@store')->name('fabricant_store');
        Route::get('/edit/{id}', 'Systeme\Stock\FabricantsController@edit')->name('fabricant_edit');
        Route::post('/update', 'Systeme\Stock\FabricantsController@update')->name('fabricant_update');
    });

    Route::prefix('magasin')->group(function () {
        Route::get('/index', 'Systeme\Stock\MagasinsController@index')->name('magasins');
        Route::get('/add', 'Systeme\Stock\MagasinsController@add')->name('magasin_add');
        Route::post('/store', 'Systeme\Stock\MagasinsController@store')->name('magasin_store');
        Route::get('/edit/{id}', 'Systeme\Stock\MagasinsController@edit')->name('magasin_edit');
        Route::post('/update', 'Systeme\Stock\MagasinsController@update')->name('magasin_update');
    });

    Route::prefix('fournisseur')->group(function () {
        Route::get('/index', 'Systeme\Stock\FournisseursController@index')->name('fournisseurs');
        Route::get('/add', 'Systeme\Stock\FournisseursController@add')->name('fournisseur_add');
        Route::post('/store', 'Systeme\Stock\FournisseursController@store')->name('fournisseur_store');
        Route::get('/edit/{id}', 'Systeme\Stock\FournisseursController@edit')->name('fournisseur_edit');
        Route::post('/update', 'Systeme\Stock\FournisseursController@update')->name('fournisseur_update');
    });

    Route::prefix('categorie')->group(function () {
        Route::get('/index', 'Systeme\Stock\CategoriesController@index')->name('categories');
        Route::get('/add', 'Systeme\Stock\CategoriesController@add')->name('categorie_add');
        Route::post('/store', 'Systeme\Stock\CategoriesController@store')->name('categorie_store');
        Route::get('/edit/{id}', 'Systeme\Stock\CategoriesController@edit')->name('categorie_edit');
        Route::get('/show/{id}', 'Systeme\Stock\CategoriesController@show')->name('categorie_show');
        Route::get('/enfant/add/{categorie}', 'Systeme\Stock\SousCategoriesController@add')->name('sous_categorie_add');
        Route::post('/enfant/store', 'Systeme\Stock\SousCategoriesController@store')->name('sous_categorie_store');
        Route::get('/enfant/edit/{id}', 'Systeme\Stock\SousCategoriesController@edit')->name('sous_categorie_edit');
        Route::post('/enfant/update', 'Systeme\Stock\SousCategoriesController@update')->name('sous_categorie_update');
        Route::post('/update', 'Systeme\Stock\CategoriesController@update')->name('categorie_update');
    });

    Route::prefix('async')->group(function () {
        Route::get('/categories', 'Systeme\Stock\CategoriesController@getAll');
        Route::get('/scategories/from/{categorie}', 'Systeme\Stock\SousCategoriesController@getFrom');
        Route::get('/scategories', 'Systeme\Stock\SousCategoriesController@getAll');
        Route::get('/personne/find/{contact}', 'PersonnesController@findjs');
        Route::post('/personne/store', 'PersonnesController@storejs');
        Route::get('/reception/find/{id}', 'Maintenance\Reception\ReceptionsController@findjs');
        Route::get('/vehicules/from/{id}', 'Maintenance\Reception\ReceptionsController@vehiculesFrom');
        Route::get('/vehicule/find/{matricule}', 'Maintenance\Reception\ReceptionsController@findVehiculejs');
        Route::get('/diagnostique/find/{reception}', 'Maintenance\Diagnostique\DiagnostiquesController@findjs');
        Route::post('/intervention/store', 'Maintenance\InterventionsController@storejs');
        Route::post('/intervention/reparation/store', 'Maintenance\InterventionsController@reparationStorejs');
        Route::post('/commentaire/reception/image/add', 'Maintenance\Reception\ReceptionsController@uploadAddjs');
        Route::post('/commentaire/reception/image/delete', 'Maintenance\Reception\ReceptionsController@uploadRemovejs');
    });

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
