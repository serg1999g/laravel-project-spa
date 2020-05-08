<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Modules\Auth\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * Login api
     *
     * @param LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $username = $request->input('email');
        $password = $request->input('password');

        return $this->authenticate('password', [
            'username' => $username,
            'password' => $password,
        ]);
    }

    /**
     * Generate a token and return
     *
     * @param string $grantType
     * @param $credentials
     * @return mixed
     */
    protected function authenticate(string $grantType, array $credentials)
    {
        $data = array_replace($credentials, [
            'grant_type' => $grantType,
            'client_id' => config('auth.proxy.client_id'),
            'client_secret' => config('auth.proxy.client_secret'),
            'scopes' => '[*]',
        ]);

        $tokenRequest = Request::create('/oauth/token', 'post', $data);
        $tokenResponse = app()->handle($tokenRequest);
        $contentString = $tokenResponse->getContent();
        $tokenContent = json_decode($contentString, true);

        if (empty($tokenContent['access_token'])) {
            return $this->sendError(__('auth.unauthenticated'));
        }

        return $this->sendResponse($tokenContent, __('auth.authenticated'));
    }
}
