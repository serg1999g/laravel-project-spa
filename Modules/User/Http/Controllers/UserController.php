<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;
use Modules\User\Models\User;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends BaseController
{

    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;
    /**
     * @var MissionRepositoryInterface
     */
    protected $missionRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param MissionRepositoryInterface $missionRepository
     */
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
     * @return JsonResponse
     */
    public function show(int $id)
    {
        $response['user'] = $this->userRepository->findUserInfo($id);
        $response['mission'] = $this->missionRepository->findMissionsByOwnerId($id);

        return $this->sendResponse($response, __('messages.userData'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        $this->authorize('update', $user);

        return $this->sendResponse($user, __('messages.userData'));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->authorize('update', $user);
        $user->fill($request->all());
        $user->save();

        return $this->respondWithArray($user);
    }

    /**
     * get all users
     *
     * @return JsonResponse
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
     * @return JsonResponse
     */
    public function AuthUser(Request $request)
    {
        $user = $request->user();
        $response = User::find($user->id)->where('id', $user->id)->get()->toArray();

        return $this->respondWithArray($response);
    }


    /**
     * get Profile Auth User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function AuthProfile(Request $request)
    {
        $user = $request->user();
        $response = $this->userRepository->findUserInfo($user->id)->toArray();
//        $response['mission'] = $this->missionRepository->findMissionsByOwnerId($user->id);

        return $this->respondWithArray($response);
    }
}
