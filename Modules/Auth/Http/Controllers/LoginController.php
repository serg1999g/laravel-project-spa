<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Modules\Auth\Http\Requests\LoginRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * Login api
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequests $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken($user->email . '-' . now())->accessToken;

            return $this->sendResponse($success, __('messages.login'));
        }
    }
}
