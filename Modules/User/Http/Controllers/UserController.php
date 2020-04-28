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
        $user = User::find($id);

        $response['user'] = $user;
        $response['image'] = $user->images()->get();
        $response['mission'] = $user->missions()->get();

        return $this->sendResponse($response, __('messages.userData'));
    }
}
