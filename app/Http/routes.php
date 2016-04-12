<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/addmovie','HomeController@serveaddmovie');
    Route::get('/','basicroutes@welcome');
    Route::get('/movie/{id}', 'basicroutes@specificmovie');
    Route::get('/settings', 'basicroutes@usersettings');
    // Route::get('/home', 'HomeController@index');
});
Route::group(['middleware' => 'web'], function () {
    Route::get('/','basicroutes@welcome');
    Route::get('/movie/{id}', 'basicroutes@specificmovie');
    // Route::get('/home', 'HomeController@index');
});
//Route::get('/','basicroutes@welcome');
Route::group(['prefix' => 'api/', 'middleware' => 'auth:api'], function(){
	// thesse routes are protected by the api_token. how ever the api_token is not being created when a user is created even though it was added to the modelfactory. users that are randomly generated however do get the api_token.
	Route::post('addmovie', 'apicalls@addmovie');
  Route::post('addcomment','apicalls@addcomment');
});

// publically available api fetches
Route::post('api/fetchmovies','apicalls@fetchmovies');
Route::post('api/fetchcomments','apicalls@fetchcomments');
