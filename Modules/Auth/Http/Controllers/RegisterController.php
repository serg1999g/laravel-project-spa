<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Modules\Auth\Http\Requests\RegisterRequests;
use Modules\User\Models\Role;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Modules\User\Services\Interfaces\RoleServiceInterface;

class RegisterController extends BaseController
{
    private $roleService;

    public function __construct(RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }

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

        $this->roleService->assignRole($role, $user);

        $success['token'] = $user->createToken($user->email . '-' . now())->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, __('messages.register'));
    }
}
