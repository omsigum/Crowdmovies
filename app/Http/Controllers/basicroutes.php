<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Auth;
class basicroutes extends Controller
{
    public function specificmovie($id){
    	// $id contains the $id of the movie that is passed to the controler
    	// DB::table('submission') -> select('moviename as name', );
    	// chcek if the movie is in out submissions and has not gone further into the progress
      $movies = DB::table('submission')
      -> select('banner','ID','IMDB')
      -> where('IMDB', $id)-> get();
      // make temp be = to the first column that the query returns.
      $temp = $movies[0];
      if ($id = Auth::id()) {
        // the user is logged in and can comment.
        $api_token = DB::table('users') -> select('api_token') -> where('id' , $id) -> get();
        $api_token = $api_token[0];
        $temp -> api_token = $api_token -> api_token;
      }
      else {
            $temp -> api_token = "not logged in";
      }
    	return View('movie') -> with('movies', $temp);
       //return json_encode($temp);
    }
    public function welcome(){
    	$movies = DB::table('submission') -> select('moviename as name','posterUrl','imdbRating','ID','IMDB','banner') -> get();
    	return view('welcome') -> with('movies', $movies);
    }
    public function usersettings(){
      $user = Auth::guard('web') -> user();
      $api_token = $user -> api_token;
      return view('pages.usersettings') -> with('api_token',$api_token);
    }
    public function serveaddmovie(){
        $user = Auth::guard('web') -> user();
        $api_token = $user -> api_token;
        return view('pages.addmovie') -> with('api_token',$api_token);
    }
}
