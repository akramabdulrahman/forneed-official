<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Auth\LoginProxy;


class LoginController extends Controller
{
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        return response()->json($this->loginProxy->attemptLogin($email, $password));
    }

    public function refresh(Request $request)
    {
        return response()->json($this->loginProxy->attemptRefresh());
    }

    public function logout()
    {
        $this->loginProxy->logout();

        return response()->json(null, 204);
    }
}