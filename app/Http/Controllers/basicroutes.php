<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class basicroutes extends Controller
{
    public function specificmovie($id){
    	// $id contains the $id of the movie that is passed to the controler
    	// DB::table('submission') -> select('moviename as name', ); 
    	// chcek if the movie is in out submissions and has not gone further into the progress
    	$movies = DB::table('submission') -> select('banner','IMDB') -> where('IMDB', $id)-> get();
    	$temp = $movies[0];
    	return View('movie') -> with('movies', $temp);
    	//return json_encode($movies);
    	//return json_encode($temp);
    }
    public function welcome(){
    	$movies = DB::table('submission') -> select('moviename as name','posterUrl', 'imdbRating','ID','IMDB','banner') -> get();
    	//return json_encode($movies);
    	return view('welcome') -> with('movies', $movies);
    }
}
