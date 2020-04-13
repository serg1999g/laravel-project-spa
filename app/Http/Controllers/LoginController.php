<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequests $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken($user->email . '-' . now())->accessToken;

            return $this->sendResponse($success, 'User logged in');
        }
    }
}
