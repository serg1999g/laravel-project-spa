<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($id)
    {
        $user = $this->userRepository->getByUser($id);

        $response['user'] = $user;
        $response['image'] = $user->images()->get();
        $response['mission'] = $user->missions()->get();

        return $this->sendResponse($response, __('messages.userData'));
    }
}
