<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;
use Modules\User\Models\User;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends BaseController
{

    protected $userRepository;
    protected $missionRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        MissionRepositoryInterface $missionRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->missionRepository = $missionRepository;
    }

    /**
     * display user data
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $response['user'] = $this->userRepository->findUserInfo($id);
        $response['mission'] = $this->missionRepository->findMissionByOwnerId($id);

        return $this->sendResponse($response, __('messages.userData'));
    }

    /**
     * get all users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = User::with('images')->get();

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
        $response = $this->userRepository->findById($user->id)->get();

        return $this->sendResponse($response, __('messages.userData'));
    }
}
