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

use App\User;

Route::get('/', function () {
    return view('welcome');
});


//Para ver todos los usuarios(por ahora, hay que hacer una para clientes y usuarios,osea hacer filtros)
Route::get('users',function(){

	$users = User::all();

	return view('users',compact('users'));

});

//grupo de rutas para la administracion
Route::group(['prefix' => 'admin'],function(){

	Route::resource('users','UsersController');
	
});

