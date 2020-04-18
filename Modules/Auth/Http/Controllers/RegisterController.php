<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Modules\Auth\Http\Requests\RegisterRequests;
use Modules\Auth\Models\Role;
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
        $role = Role::where('name', 'user')->first();

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->assingRole($role);

        $success['token'] = $user->createToken($user->email . '-' . now())->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, __('messages.register'));
    }
}
