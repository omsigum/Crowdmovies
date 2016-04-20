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
use App\comment;
use App\submission;

class apicalls extends Controller
{
	public function addmovie(Request $request){
		$input = $request -> all();
		$user = Auth::guard('api') -> user();
		$userid = $user -> id;
		$output = submission::findidmbid($input['link']);
		if (isset($output)) {
			$uuid = Uuid::uuid1();
			$client = new HttpClient;
			$jsonresponse = $client->get('http://www.omdbapi.com/?i='.$output.'&tomatoes=true') -> json();
			$client = new HttpClient;
			$bannerobject = $client->get('http://api.themoviedb.org/3/find/'.$output.'?external_source=imdb_id&api_key=5d81354b9914da922744f60e566d30b0') -> json();
			$banner = 'http://image.tmdb.org/t/p/w500/'. $bannerobject -> movie_results[0] -> backdrop_path;
			if (submission::IMDBidvalid($output) != 1) {
				return "movie exists";
			}
			if (isset($jsonresponse)) {
				if ($jsonresponse -> Response == 'True') {
					$movie = new submission;
					$movie -> userID = $userid;
					$movie -> IMDB = $output;
					$movie -> id = $uuid;
					$movie -> moviename = $jsonresponse -> Title;
					$movie -> posterUrl = $jsonresponse -> Poster;
					$movie -> imdbRating = $jsonresponse -> imdbRating;
					$movie -> banner = $banner;
					$movie -> save();
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
		$userid = $user -> id;
		$comment = new comment;
		$comment -> content = $input['content'];
		$comment -> userID = $userid;
		$comment -> submissionID = $input['submissionID'];
		$comment -> id = Uuid::uuid1();
		$comment -> save();
		return 1;
	}
	public function fetchcomments(Request $request){
		$input = $request -> all();
		$comment = comment::where('submissionID', $input['submissionID'])
               ->orderBy('created_at', 'desc')
               ->get();
		return $comment;
	}
	public function editcomment(Request $request){
		$input = $request -> all();
		// check if the user owns the comment
		$user = Auth::guard('api') -> user();
		// this method needs api_token, commentID, newcontent
		$comment = comment::where('id', $input['commentid']) -> first();
		if ($comment -> userID == $user -> id) {
			// the user owns the comment
			$comment -> content = $input['content'];
			$comment -> save();
			return "1";
		}
		else {
			// the user does not own the comment and cannot edit it
			return "Not the owner ofthe comment";
		}
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
