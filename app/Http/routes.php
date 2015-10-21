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


	// GET
Route::get('projets/',[ 'as' => 'projets.index' , 'uses' => 'ProjetController@index']);
Route::get('projets/add',[ 'as' => 'projets.add' , 'uses' => 'ProjetController@add']);
Route::get('projets/supprimer/{id}',[ 'as' => 'projets.supprimer' , 'uses' => 'ProjetController@destroy']);
Route::get('projets/modifier/{id}',[ 'as' => 'projets.modifier' , 'uses' => 'ProjetController@showmodifier']);
Route::get('projets/afficher/{id}',[ 'as' => 'projets.afficher' , 'uses' => 'ProjetController@show']);
	// POST
Route::post('projets/add',[ 'as' => 'projets.addprojet' , 'uses' => 'ProjetController@addprojet']);
Route::post('projets/modifier/',[ 'as' => 'projets.modifier' , 'uses' => 'ProjetController@edit']);
