<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\updates;
use Auth;
class adminroutes extends Controller
{
    // more functionality is hard to imageine for updates
  public function addupdate(Request $request){
    $input = $request -> all();
    $update = new updates;
    $update -> content = $input['content'];
    $update -> submissionID = $input['submissionID'];
    $update -> title = $input['title'];
    $update -> save();
    // the users maybe need like a email or some stuff.
    return 1;
  }
}
