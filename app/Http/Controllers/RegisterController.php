<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\RegisterRequests;
use App\User;
use Illuminate\Http\Request;


class RegisterController extends BaseController
{

    /**
     * Register api
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequests $request)
    {
//        if ($request->messages()) {
//            return $this->sendError('Validation Error.', $request->messages());
//        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $success['token'] = $user->createToken('Token Name')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }
}
