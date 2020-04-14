<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

class LogoutController extends BaseController
{
    /**
     * Logout api
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->sendResponse(null, __('messages.logout'));
    }
}
