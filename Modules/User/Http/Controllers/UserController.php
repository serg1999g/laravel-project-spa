<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;
use Modules\User\Http\Resources\UserResource;
use PHPUnit\Util\Json;

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
     * @param int $id
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request, int $id)
    {
        $user = $request->user();
        $response = $this->missionRepository->findMissionsByOwnerId($id);
        $this->authorize('update', $user);

        return $this->sendResponse($response, __('messages.userData'));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->authorize('update', $user);
        $user->fill($request->all());
        $user->save();

        return $this->respondWithArray(['data' => $user]);
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
     * @return UserResource
     */
    public function AuthProfile(Request $request)
    {
        $user = $request->user();
        $response = UserResource::make($user);

        return $this->respondWithArray(['data' => $response]);
    }

    /**
     * Change password
     *
     * @param Request $request
     * @return JsonResponse|Json
     */
    public function changePassword(Request $request)
    {
        $authUser = $request->user();

        $user = User::find($authUser->id);

        $oldPassword = $request->input('current_password');
        $newPassword = $request->input('password');

        if (Hash::check($oldPassword, $user->password)) {

            $user->password = bcrypt($newPassword);
            $user->save();

            return $this->respondWithMessage('changed');
        }
        return $this->sendError('Incorrect current password');
    }
}
