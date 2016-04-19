<?php

Route::group(['middleware' => 'web'], function () {
      Route::get('/addmovie','basicroutes@serveaddmovie');
      Route::get('/','basicroutes@welcome');
      Route::get('/movie/{id}', 'basicroutes@specificmovie');
      Route::get('/settings', 'basicroutes@usersettings');
});
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/','basicroutes@welcome');
    Route::get('/movie/{id}', 'basicroutes@specificmovie');
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
  Route::post('editcomment','apicalls@editcomment');
});
// Administrator route groups
Route::group(['prefix' => 'admin/', 'middleware' => ['web','admin']], function(){
  Route::get('login', 'adminroutes@login');
});
// publically available api fetches
Route::post('api/fetchmovies','apicalls@fetchmovies');
Route::post('api/fetchcomments','apicalls@fetchcomments');
