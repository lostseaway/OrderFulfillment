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

Route::get('/json', array(
			'as' => 'orders-get-json',
			'uses' => 'OrdersController@getJsonTemplate'
	));
Route::get('/test', array(
		'as' => 'test',
		'uses' => 'OrdersController@getTest'
	));
Route::post('/orders/fulfill', array(
		'as' => 'order-post-fulfill',
		'uses' => 'OrdersController@fulfill'
	));
Route::post('/orders/grap', array(
		'as' => 'order-post-grap',
		'uses' => 'OrdersController@grap'
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
		Route::get('/orders/{id}/status' , array(
			'as' => 'get-api-orders-id' ,
			'uses' => 'ApiController@getOrderStatusByID'
		));
		Route::post('/orders', array(
			'as' => 'orders-post',
			'uses' => 'ApiController@postOrder'
		));
		Route::put('/orders/{id}/order_status', array(
			'as' => 'orders-put-orderstatus',
			'uses' => 'ApiController@updateOrderStatus'
		));		
		Route::put('/orders/{id}/payment_status', array(
			'as' => 'orders-put-paymentstatus',
			'uses' => 'ApiController@updatePaymentStatus'
		));	
		Route::put('/orders/{id}/shipping_status', array(
			'as' => 'orders-put-shippingstatus',
			'uses' => 'ApiController@updateShippingStatus'
		));	
	});
