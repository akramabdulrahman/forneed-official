<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class UserController extends Controller
{

    public function __construct()
    {
        $this->content = array();
    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (Auth::check(['email' => $input['email'], 'password' => $input['password'],false, false])) {

            $this->content['access_token'] = User::where('email','=',$input['email'])->first()->createToken(Auth::user()->username)->accessToken;
            $status = 200;
        } else {
            $this->content['error'] = "Unauthorised";
            $status = 401;
        }
        return response()->json($this->content, $status);
    }
}
