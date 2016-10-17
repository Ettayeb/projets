<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

	// GET
Route::get('projets/',[ 'as' => 'projets.index' , 'uses' => 'ProjetController@index']);
Route::get('projets/add',[ 'as' => 'projets.add' , 'uses' => 'ProjetController@add']);
Route::get('projets/supprimer/{id}',[ 'as' => 'projets.supprimer' , 'uses' => 'ProjetController@destroy']);
Route::get('projets/modifier/{id}',[ 'as' => 'projets.modifier' , 'uses' => 'ProjetController@showmodifier']);
Route::get('projets/afficher/{id}',[ 'as' => 'projets.afficher' , 'uses' => 'ProjetController@show']);
	// POST
Route::post('projets/add',[ 'as' => 'projets.addprojet' , 'uses' => 'ProjetController@addprojet']);
Route::post('projets/modifier/',[ 'as' => 'projets.modifier' , 'uses' => 'ProjetController@edit']);


//GET
Route::get('produit/add',[ 'as' => 'produit.add' , 'uses' => 'ProduitController@showaddform']);
Route::get('produit',[ 'as' => 'produit.index' , 'uses' => 'ProduitController@index']);
Route::get('produit/modifier/{id}',[ 'as' => 'produit.modifier' , 'uses' => 'ProduitController@showmodifier']);
Route::get('produit/supprimer/{id}',[ 'as' => 'produit.supprimer' , 'uses' => 'ProduitController@destroy']);
Route::get('statics',[ 'as' => 'statics.index' , 'uses' => 'ProduitController@statics']);


//POST
Route::post('produit/add',[ 'as' => 'produit.add' , 'uses' => 'ProduitController@add']);
Route::post('produit',[ 'as' => 'produit.modifier' , 'uses' => 'ProduitController@edit']);
Route::post('produit/quantite',[ 'as' => 'produit.operation' , 'uses' => 'ProduitController@operation']);
Route::post('statics',[ 'as' => 'statics.index' , 'uses' => 'ProduitController@showstatics']);

});

Route::auth();

Route::get('/home', 'HomeController@index');
