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
// returns the welcome page This is the only page that is not affected by the auth controller 
// all other pages that do not need authentication have to be added straight into the routes file
Route::get('/', function () {
    return view('welcome');
});


// auth controller
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/addmovie','HomeController@serveaddmovie');
    Route::get('/home', 'HomeController@index');
});

Route::group(['prefix' => 'api/', 'middleware' => 'auth:api'], function(){
	// thesse routes are protected by the api_token. how ever the api_token is not being created when a user is created even though it was added to the modelfactory. users that are randomly generated however do get the api_token. 
	Route::post('addmovie', 'apicalls@addmovie');
});
