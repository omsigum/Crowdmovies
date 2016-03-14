<?php

namespace App\Http\Controllers;
// theese two are required for the use of buzz http library
require('../vendor/autoload.php');
use Buzz;


use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class apicalls extends Controller
{

	public function addmovie(Request $request){
		// get like the data from like the user u know
		$input = $request -> all();
		$userid = DB::table('users')->where('api_token', $input['api_token'])->value('ID');; // i dont even have a clue how to get this
		$imdblink = $input['link']; // it could be something like $_POST['imdb']; but no... lets not do that
		$oldletter = "";
		$index = 0;
		$idfound = false;
		for ($i=0; $i < strlen($imdblink); $i++) { 
			if ($oldletter == $imdblink[$i] && $oldletter == "t" && is_numeric($imdblink[$i + 1])) {
				// if there are two t's in a row then set the index of t to i -1 and substr 9 up.
				$index = $i - 1;
				$idfound = true;
				break;
			}
			$oldletter = $imdblink[$i];
		}
		if (!$idfound) {
			return "could not find a valid id in that url";
		}
		else{
		$uuid1 = Uuid::uuid1();
		$output = substr($imdblink, $index, 9);
		// return $output;
		// insert like u know data into u know like a database

		// get basic information from the omdb. The information we sotre in the database is just information that we display on the front page
		// this is to save the time it takes to display the front page
		$request = new Buzz\Message\Request('GET', '/', 'http://www.omdbapi.com/?i='.$output.'&tomatoes=true');
		$response = new Buzz\Message\Response();
		$client = new Buzz\Client\FileGetContents();
		$client -> send($request,$response);
		$thing = json_decode($response);
		//return $thing -> imdbRating;
		DB::table('submission')->insert([ // okei okei, he is like just inserting you know
    	['userID' => $userid, 'IMDB' => $output, 'ID' => $uuid1, 'moviename' => $thing -> Title, 'posterUrl' => $thing -> Poster, 'imdbRating' => $thing -> imdbRating] // that is not code i have ever seen before...
		]);
		return 1;
	}
	}
	public function deletemovie(){

	}
	public function approvemovie(){

	}
}
