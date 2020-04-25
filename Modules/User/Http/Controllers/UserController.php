<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\User\Repositories\UserRepository;

class UserController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($id)
    {
        $user = $this->userRepository->getByUser($id);
        $user->images;
        $response['user'] = $user;

        return $this->sendResponse($response, __('messages.userData'));
    }
}
