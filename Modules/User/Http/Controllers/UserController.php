<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\Auth\Models\User;

class UserController extends BaseController
{
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return $this->sendResponse($user, __('messages.userData'));
        }

        return $this->sendError(__('messages.errorUser'));
    }
}
