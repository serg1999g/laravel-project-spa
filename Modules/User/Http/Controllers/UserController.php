<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\User\Models\User;

class UserController extends BaseController
{

    /**
     * display user data
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $response['user'] = User::with(['images', 'missions'])->where('id', $id)->get();

        return $this->sendResponse($response, __('messages.userData'));
    }

    /**
     * get all users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = User::with(['images'])->get();

        return $this->sendResponse($response, __('messages.userData'));
    }

    /**
     * get authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function AuthUser(Request $request)
    {
        $user = $request->user();

        $response = User::with(['images'])->where('id', $user->id)->get();

        return $this->sendResponse($response, __('messages.userData'));
    }
}
