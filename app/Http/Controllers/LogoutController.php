<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends BaseController
{
    /**
     * Logout api
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->sendResponse(null, __('messages.logout'));
    }
}
