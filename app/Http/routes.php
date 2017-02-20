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
Route::get('', 'HomeController@index');/*Con eso no aparece el login si uno esta con session iniciada*/

//grupo de rutas para la administracion
Route::group(['prefix' => 'admin', 'middleware' => ['auth','is_admin']],function(){
	/*Usuarios*/
	Route::resource('users','UsersController');
	Route::get('users/eliminar/{id}',[
		'uses' => 'UsersController@eliminar',
		'as' => 'admin.users.eliminar'
	]);
	Route::get('users/agregar/{id}',[
		'uses' => 'UsersController@agregar',
		'as' => 'admin.users.agregar'
	]);
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
	Route::get('users/autocomplete/auto',[
		'uses' => 'UsersController@autocomplete',
		'as' => 'admin.users.autocomplete'
	]);
	Route::get('users/password/edit/{id}',[
		'uses' => 'UsersController@password',
		'as' => 'admin.users.password'
	]);
	Route::post('users/password/edit/{id}',[
		'uses' => 'UsersController@cambiopassword',
		'as' => 'admin.users.cambiopassword'
	]);
	/*Carreras*/
	Route::resource('carreras', 'CarrerasController');
	Route::get('carreras/eliminar/{id}',[
		'uses' => 'CarrerasController@eliminar',
		'as' => 'admin.carreras.eliminar'
	]);
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
	Route::get('bicicletas/editar/{id}',[
		'uses' => 'BicicletasAdminController@editar',
		'as' => 'admin.bicicletas.editar'
	]);
	Route::get('bicicletas/eliminar/{id}',[
		'uses' => 'BicicletasAdminController@eliminar',
		'as' => 'admin.bicicletas.eliminar'
	]);
	Route::get('bicicletas/retiro/{id}',[
		'uses' => 'BicicletasAdminController@retiro',
		'as' => 'admin.bicicletas.retiro'
	]);
	Route::get('bicicletas/mostrar/{id}',[
		'uses' => 'BicicletasAdminController@mostrar',
		'as' => 'admin.bicicletas.mostrar'
	]);
	Route::get('bicicletas/nota/{id}',[
		'uses' => 'BicicletasAdminController@nota',
		'as' => 'admin.bicicletas.nota'
	]);
	Route::get('bicicletas/{id}/create',[
		'uses' => 'BicicletasAdminController@create',
		'as' => 'admin.bicicletas.create'
	]);
	Route::get('bicicletas/{id}/destroy',[
		'uses' => 'BicicletasAdminController@destroy',
		'as' => 'admin.bicicletas.destroy'
	]);
	Route::get('bicicletas/{id}/cambiar',[
		'uses' => 'BicicletasAdminController@cambiar',
		'as' => 'admin.bicicletas.cambiar'
	]);
	Route::get('bicicletas/{id}/note',[
		'uses' => 'BicicletasAdminController@note',
		'as' => 'admin.bicicletas.note'
	]);
	Route::get('bicicletas/{id}',[
		'uses' => 'BicicletasAdminController@show',
		'as' => 'admin.bicicletas.detalle'
	]);	
	Route::get('bicicletas/ingreso/ingreso',[
		'uses' => 'BicicletasAdminController@ingreso',
		'as' => 'admin.bicicletas.ingreso'
	]);
	Route::get('bicicletas/ingresa/bike',[
		'uses' => 'BicicletasAdminController@ingresa',
		'as' => 'admin.bicicletas.ingresa'
	]);
	Route::get('bicicletas/detalle/hoy',[
		'uses' => 'BicicletasAdminController@detallehoy',
		'as' => 'admin.bicicletas.hoy'
	]);

});



//grupo de rutas para los funcionarios
Route::group(['prefix' => 'funcionario', 'middleware' => ['auth','is_funcionario']],function(){
	/*USERS*/
	Route::resource('users','FuncionarioController');
	Route::get('home',[
		'uses' => 'FuncionarioController@home',
		'as' => 'funcionario.home'
	]);
	Route::get('users/agregar/{id}',[
		'uses' => 'FuncionarioController@agregar',
		'as' => 'funcionario.users.agregar'
	]);
	Route::get('users/autocomplete/auto',[
		'uses' => 'FuncionarioController@autocomplete',
		'as' => 'funcionario.users.autocomplete'
	]);
	Route::get('users/{id}',[
		'uses' => 'FuncionarioController@show',
		'as' => 'funcionario.users.detalle'
	]);
	Route::get('users/password/edit/{id}',[
		'uses' => 'FuncionarioController@password',
		'as' => 'funcionario.users.password'
	]);
	Route::post('users/password/edit/{id}',[
		'uses' => 'FuncionarioController@cambiopassword',
		'as' => 'funcionario.users.cambiopassword'
	]);

	/*CARRERAS*/
	Route::resource('carreras', 'CarrerasFuncionarioController');
	Route::get('carreras/{id}',[
		'uses' => 'CarrerasFuncionarioController@show',
		'as' => 'funcionario.carreras.detalle'
	]);


	/*BICICLETAS*/
	Route::resource('bicicletas', 'BicicletasFuncController');
	Route::get('bicicletas/editar/{id}',[
		'uses' => 'BicicletasFuncController@editar',
		'as' => 'funcionario.bicicletas.editar'
	]);
	Route::get('bicicletas/nota/{id}',[
		'uses' => 'BicicletasFuncController@nota',
		'as' => 'funcionario.bicicletas.nota'
	]);
	Route::get('bicicletas/mostrar/{id}',[
		'uses' => 'BicicletasFuncController@mostrar',
		'as' => 'funcionario.bicicletas.mostrar'
	]);
	Route::get('bicicletas/retiro/{id}',[
		'uses' => 'BicicletasFuncController@retiro',
		'as' => 'funcionario.bicicletas.retiro'
	]);
	Route::get('bicicletas/{id}/create',[
		'uses' => 'BicicletasFuncController@create',
		'as' => 'funcionario.bicicletas.create'
	]);

	Route::get('bicicletas/{id}/cambiar',[
		'uses' => 'BicicletasFuncController@cambiar',
		'as' => 'funcionario.bicicletas.cambiar'
	]);

	Route::get('bicicletas/{id}/note',[
		'uses' => 'BicicletasFuncController@note',
		'as' => 'funcionario.bicicletas.note'
	]);

	Route::get('bicicletas/{id}',[
		'uses' => 'BicicletasFuncController@show',
		'as' => 'funcionario.bicicletas.detalle'
	]);	
	Route::get('bicicletas/ingreso/ingreso',[
		'uses' => 'BicicletasFuncController@ingreso',
		'as' => 'funcionario.bicicletas.ingreso'
	]);
	Route::get('bicicletas/ingresa/bike',[
		'uses' => 'BicicletasFuncController@ingresa',
		'as' => 'funcionario.bicicletas.ingresa'
	]);
	Route::get('bicicletas/detalle/hoy',[
		'uses' => 'BicicletasFuncController@detallehoy',
		'as' => 'funcionario.bicicletas.hoy'
	]);
});

Route::group(['prefix' => 'cliente', 'middleware' => ['auth','is_cliente']],function(){
	Route::resource('users','ClienteController');
	Route::get('home',[
		'uses' => 'ClienteController@home',
		'as' => 'cliente.home'
	]);
	Route::get('user/{id}',[
		'uses' => 'ClienteController@show',
		'as' => 'cliente.users.detalle'
	]);
	Route::get('users/password/edit/{id}',[
		'uses' => 'ClienteController@password',
		'as' => 'cliente.users.password'
	]);
	Route::post('users/password/edit/{id}',[
		'uses' => 'ClienteController@cambiopassword',
		'as' => 'cliente.users.cambiopassword'
	]);

	/*BICICLETAS*/
	Route::resource('bicicletas', 'BicicletaClienteController');
	Route::get('bicicletas/editar/{id}',[
		'uses' => 'BicicletaClienteController@editar',
		'as' => 'funcionario.bicicletas.editar'
	]);
});
