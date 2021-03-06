<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // create an api_token and a remember_token
        $api_token = "";
        $allowedchars = "qwertyuiopasdfghjklzxcvbnm1234567890";
        for ($i=0; $i < 60; $i++) {
            $api_token = $api_token . $allowedchars[rand(0,strlen($allowedchars)- 1)];
        }
        $remember_token = "";
        for ($i=0; $i < 100; $i++) {
            $remember_token = $remember_token . $allowedchars[rand(0, strlen($allowedchars) -1)];
        }
        // now api_token contains a random string.
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => $api_token,
            'remember_token' => $remember_token,
            'username' => $data['username']
        ]);
    }
    public function isAdmin(){
      // get the user from Auth if the user has state = 1 then he gets through. else not.
      $user = Auth::guard('web') -> user();
      if ($user -> state != 1) {
        return 0;
      }
      else {
        return 1;
      }
    }
}
