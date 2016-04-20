<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class submission extends model
{
    // this class is to clean the controllers
    public static function findidmbid($imdblink){
      $index = 0;
      $oldletter = "";
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
  		return substr($imdblink, $index, 9);
    }

    public static function IMDBidvalid($imdblink){
      $movie = submission::where('IMDB', $imdblink)
              -> orderBy('created_at', 'desc')
              -> first();
      // here you can check if a movie is aplicable
      if (!isset($movie -> moviename)) {
        // the imdb link has never been here before.
        return 1;
      }
      else if(!isset($movie -> showtime)){
        // the movie exists but has not been shown
        return 0;
      }
      else {
        // get the time in seconds..... nenni ekki að læra á eitthverja tíma klassa, just make it seconds
        $showtime = strtotime($movie -> showtime);
        if ($showtime + (3600 * 12 * 30) < time()) {
          return 1;
        }
        else {
          return 0;
        }
      }
    }
    protected $table = 'submission';
}
