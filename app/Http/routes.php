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
    return view('auth.login');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//grupo de rutas para la administracion
Route::group(['prefix' => 'admin', 'middleware' => ['auth','is_admin']],function(){
	/*Usuarios*/
	Route::resource('users','UsersController');
	Route::get('users/{id}/destroy',[
		'uses' => 'UsersController@destroy',
		'as' => 'admin.users.destroy'
	]);
	Route::get('users/{id}',[
		'uses' => 'UsersController@show',
		'as' => 'admin.users.detalle'
	]);
	Route::get('home',[
		'uses' => 'UsersController@home',
		'as' => 'admin.home'
	]);
	/*Carreras*/
	Route::resource('carreras', 'CarrerasController');
	Route::get('carreras/{id}',[
		'uses' => 'CarrerasController@show',
		'as' => 'admin.carreras.detalle'
	]);
	Route::get('carreras/{id}/destroy',[
		'uses' => 'CarrerasController@destroy',
		'as' => 'admin.carreras.destroy'
	]);
	/*Bicicletas*/
	Route::resource('bicicletas', 'BicicletasAdminController');
	Route::get('bicicletas/{id}/create',[
		'uses' => 'BicicletasAdminController@create',
		'as' => 'admin.bicicletas.create'
	]);
	



	
});

//grupo de rutas para los funcionarios
Route::group(['prefix' => 'funcionario','middleware' => 'auth'],function(){

	Route::resource('users','FuncionarioController');
	Route::get('home',[
		'uses' => 'FuncionarioController@home',
		'as' => 'funcionario.home'
	]);
	Route::get('users/{id}',[
		'uses' => 'FuncionarioController@show',
		'as' => 'funcionario.users.detalle'
	]);

	Route::resource('carreras', 'CarrerasFuncionarioController');
	Route::get('carreras/{id}',[
		'uses' => 'CarrerasFuncionarioController@show',
		'as' => 'funcionario.carreras.detalle'
	]);

	Route::resource('bicicletas', 'BicicletasFuncController');
	Route::get('bicicletas/{id}/create',[
		'uses' => 'BicicletasFuncController@create',
		'as' => 'funcionario.bicicletas.create'
	]);
	
});




