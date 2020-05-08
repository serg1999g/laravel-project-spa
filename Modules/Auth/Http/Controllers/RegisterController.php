<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Image\Services\Interfaces\ImageUserServiceInterface;
use Modules\User\Models\Role;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Modules\User\Services\Interfaces\RoleServiceInterface;

class RegisterController extends BaseController
{
    /**
     * @var ImageUserServiceInterface
     */
    protected $imageUserService;

    /**
     * @var RoleServiceInterface
     */
    protected $roleService;

    /**
     * RegisterController constructor.
     * @param RoleServiceInterface $roleService
     * @param ImageUserServiceInterface $imageUserService
     */
    public function __construct(
        RoleServiceInterface $roleService,
        ImageUserServiceInterface $imageUserService
    )
    {
        $this->roleService = $roleService;
        $this->imageUserService = $imageUserService;
    }

    /**
     * Register api
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $role = Role::where('name', 'user')->first();

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if ($request->has('image')) {
            $this->imageUserService->create($user, $request->file('image'));
        }

        $this->roleService->assignRole($role, $user);

        return $this->sendResponse(true, __('messages.register'));
    }
}
