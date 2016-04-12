<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/addmovie','basicroutes@serveaddmovie');
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
	Route::post('addmovie', 'apicalls@addmovie');
  Route::post('addcomment','apicalls@addcomment');
  Route::post('updateuserinfo','apicalls@updateuserinfo');
  Route::post('changeuserpassword','apicalls@changeuserpassword');
  Route::post('changeuseremail', 'apicalls@changeuseremail');
  Route::post('changeusersname', 'apicalls@changeusersname');
  Route::post('changeusername','apicalls@changeusername');
});

// publically available api fetches
Route::post('api/fetchmovies','apicalls@fetchmovies');
Route::post('api/fetchcomments','apicalls@fetchcomments');
