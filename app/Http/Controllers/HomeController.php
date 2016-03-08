<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function serveaddmovie(){
        // fetch the api token and pass it in the view so that js can take advantage of it once posting
        $id = Auth::id();
        // get the users api_token from the id that is asosiated with his session u know
        $api_token = DB::table('users')->where('ID', 1)->value('api_token');
        return view('pages.addmovie', ['api_token' => $api_token]);
    }
}
