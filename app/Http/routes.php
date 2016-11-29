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


Route::group(['middleware' => ['web']], function(){
		Route::get('/', function () {
	    return view('auth.login');
	});

	Route::auth();

	Route::get('/home', 'HomeController@index');

	//grupo de rutas para la administracion
	Route::group(['prefix' => 'admin'],function(){

		Route::resource('users','UsersController');
		Route::get('users/{id}/destroy',[
			'uses' => 'UsersController@destroy',
			'as' => 'admin.users.destroy'
		]);
		Route::get('users/{id}',[
			'uses' => 'UsersController@show',
			'as' => 'admin.users.detalle'
		]);

		
	});

	//grupo de rutas para los funcionarios
	Route::group(['prefix' => 'funcionario'],function(){

		Route::resource('users','FuncionarioController');
		
	});
});


