<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Vinelab\Http\Client as HttpClient;
use App\Http\Requests;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Auth;
use Hash;

class apicalls extends Controller
{
	public function addmovie(Request $request){
		$input = $request -> all();
		$userid = DB::table('users')->where('api_token', $input['api_token'])->value('ID'); // i dont even have a clue how to get this
		$imdblink = $input['link']; // it could be some response like $_POST['imdb']; but no... let's not do that
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
		if ($idfound) {
			$output = substr($imdblink, $index, 9);
			$uuid = Uuid::uuid1();
			$client = new HttpClient;
			$response = $client->get('http://www.omdbapi.com/?i='.$output.'&tomatoes=true');
			$client = new HttpClient;
			$response2 = $client->get('http://api.themoviedb.org/3/find/'.$output.'?external_source=imdb_id&api_key=5d81354b9914da922744f60e566d30b0');
			if (isset($response) && isset($response)) {
				$jsonresponse2 = $response2->json();
				$jsonresponse = $response->json();
				if ($jsonresponse -> Response == 'True') {
					$banner = 'http://image.tmdb.org/t/p/w500/'. $jsonresponse2 -> movie_results[0] -> backdrop_path;
					DB::table('submission')->insert([ // okei okei, he is like just inserting you know
			    	['userID' => $userid, 'IMDB' => $output, 'ID' => $uuid, 'moviename' => $jsonresponse -> Title, 'posterUrl' => $jsonresponse -> Poster, 'imdbRating' => $jsonresponse -> imdbRating, 'banner' => $banner] // that is not code i have ever seen before...
					]);
					return 1;
				}
				else{
					// omdb returns but returns an error or movie api
					return $jsonresponse -> Error;
				}
				}
				else{
					return '{"sucess":"false","ex":"unable to get response from omdb"}';
				}
			}
		else{
			return '{"sucess":"false","ex":"Movie id not found in string"}';
		}
	}
	public function deletemovie(){

	}
	public function approvemovie(){

	}
	public function fetchmovies(){
		return json_encode(DB::table('submission') -> select('moviename as name','posterUrl', 'imdbRating','ID','IMDB') -> get());
	}
	public function addcomment(Request $request){
		$input = $request -> all();
		$user = Auth::guard('api') -> user();
		$userid = $user -> id();
		DB::table('comment')->insert([['userID' => $userid, 'content' => $input['content'], 'submissionID' => $input['submissionID']]]);
		return 1;
	}
	public function fetchcomments(Request $request){
		// get like the data from like the user u know
		$input = $request -> all();
		$comments = DB::table('comment')
		->join('users', 'users.id', '=', 'comment.userID')
		->select('content','userID','name')
		->where('submissionID', $input['submissionID'])
		-> get();
		return $comments;
	}
	public function changeuserpassword(Request $request){
		$input = $request -> all();
		$user = Auth::guard('api') -> user();
		// verify the old user password
		if (Hash::check($input['oldpass'], $user -> password)) {
			// the old password is verified
			$user -> password = Hash::make($input['newpass']);
			$user -> save();
			return 1;
		}
		else {
			return "Wrong pass";
		}
	}
	public function changeuseremail(Request $request){
		$input = $request -> all();
		$user = Auth::guard('api') -> user();
		$user -> email = $input['email'];
		$user -> save();
		return 1;
	}
	public function changeusersname(Request $request){
		$input = $request -> all();
		$user = Auth::guard('api') -> user();
		$user -> name = $input['name'];
		$user -> save();
		return 1;
	}
	public function changeusername(Request $request){
		$input = $request -> all();
		$user = Auth::guard('api') -> user();
		$user -> username = $input['username'];
		$user -> save();
		return 1;
	}
}
