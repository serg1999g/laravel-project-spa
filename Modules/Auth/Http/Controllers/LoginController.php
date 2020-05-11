<?php

namespace Modules\Auth\Http\Controllers;

use Modules\Auth\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends AuthenticateController
{
    /**
     * Login api
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $username = $request->input('email');
        $password = $request->input('password');

        return $this->authenticate('password', [
            'username' => $username,
            'password' => $password,
        ]);
    }
}
