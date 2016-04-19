<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web','logQuery']], function () {
    Route::auth();
    
    Route::get('/', ['middleware' => 'auth',  function () {
        return view('welcome');
    }]);
    
    Route::get('/home', 'HomeController@index');
    
    //orgao
    Route::resource('orgaos', 'OrgaoController');
    //User
    Route::resource('users', 'UserController');
    //unidade
    Route::resource('unidades', 'UnidadeController');
    //tipo equipamento
    Route::resource('tipo_equipamentos', 'TipoEquipamentoController');
    //local equipamento
    Route::resource('local_equipamentos', 'LocalEquipamentoController');
    //equipamento
    Route::post('status/{id}', 'EquipamentoController@storeStatus');
    //Route::resource('status_equipamento', 'StatusEquipamentoController',['only' => ['index', 'show']]);
    Route::resource('equipamentos', 'EquipamentoController');

});