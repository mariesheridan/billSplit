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

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', function () {
//        return view('welcome');
        return redirect()->route('home');
    });
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/create_transaction', 'CreateTransactionController@index');
    Route::post('/update_transaction', 'UpdateTransactionController@update');
    Route::get('/create_persons', ['as' => 'create_persons', 'uses' => 'CreatePersonsController@index']);
    Route::post('/update_persons', 'UpdatePersonsController@update');
    Route::get('/create_items', ['as' => 'create_items', 'uses' => 'CreateItemsController@index']);
    Route::post('/update_items', 'UpdateItemsController@update');
    Route::get('/summary', ['as' => 'summary', 'uses' => 'SummaryController@index']);
});
