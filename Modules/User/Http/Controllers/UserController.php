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
        $user = $this->userRepository->getById($id);
        if ($user) {
            return $this->sendResponse($user, __('messages.userData'));
        }

        return $this->sendError(__('messages.errorUser'));
    }
}
