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
//    Route::get('/', function () {
//        return view('welcome');
//    });
    Route::get('/', 'WelcomeController@index');
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/create_transaction', ['as' => 'create_transaction', 'uses' => 'CreateTransactionController@index']);
    Route::post('/update_transaction', 'UpdateTransactionController@update');
    Route::get('/create_persons', ['as' => 'create_persons', 'uses' => 'CreatePersonsController@index']);
    Route::post('/update_persons', 'UpdatePersonsController@update');
    Route::get('/create_items', ['as' => 'create_items', 'uses' => 'CreateItemsController@index']);
    Route::post('/update_items', 'UpdateItemsController@update');
    Route::get('/order_details', ['as' => 'order_details', 'uses' => 'OrderDetailsController@index']);
    Route::post('/update_orders', 'UpdateOrderDetailsController@update');
    Route::get('/summary', ['as' => 'summary', 'uses' => 'SummaryController@index']);
    Route::get('/tag/{id}', ['as' => 'tag', 'uses' => 'TagController@index']);
    Route::post('/save_the_tag', 'TagController@save');
    Route::post('/save_new_transaction', 'SaveNewTransactionController@update');
    Route::resource('transactions', 'TransactionController');
});
