<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@showWelcome')
);
Route::group( array('before' => 'guest'), function(){
	Route::group( array('before' => 'csrf') , function(){
		Route::post('/user/signin' , array(
			'as' => 'sign-in-post',
			'uses' => 'AuthenController@postLogin'
		));
		Route::get('/user/signin' , array(
			'as' => 'sign-in-get',
			'uses' => 'AuthenController@getLogin'
		));

		Route::get('/user/signout' , array(
			'as' => 'sign-out-get',
			'uses' => 'AuthenController@getSignOut'
		));
		
	});
	
});
Route::get('/orders', array(
			'as' => 'orders-get',
			'uses' => 'OrdersController@show'
	));
Route::get('/orders/{id}', array(
			'as' => 'orders-get-id',
			'uses' => 'OrdersController@showId'
	));
Route::post('/orders/', array(
		'as' => 'orders-post',
		'uses' => 'OrdersController@postOrder'
	));
Route::get('/json', array(
			'as' => 'orders-get-json',
			'uses' => 'OrdersController@getJsonTemplate'
	));

Route::group(array('prefix' => 'api/v1'), function()
	{
		Route::get('/orders' , array(
			'as' => 'get-api-orders' ,
			'uses' => 'ApiController@getOrder'
		));	
	    Route::get('/orders/{id}' , array(
			'as' => 'get-api-orders-id' ,
			'uses' => 'ApiController@getOrderByID'
		));		
	});
