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

    public function edit(int $id)
    {
        $user = User::findOrFail($id);

    }
}
