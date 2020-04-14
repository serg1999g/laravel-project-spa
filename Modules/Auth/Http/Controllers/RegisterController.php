<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Modules\Auth\Http\Requests\RegisterRequests;
use Modules\Auth\Models\User;
use Illuminate\Http\Request;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
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

        $success['token'] = $user->createToken($user->email . '-' . now())->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, __('messages.register'));
    }
}
