<?php

namespace Modules\Mission\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Mission\Http\Requests\MissionRequests;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;
use Modules\Mission\Services\Interfaces\MissionServiceInterface;
use Modules\User\Models\User;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

/**
 * Class MissionController
 * @package Modules\Mission\Http\Controllers
 */
class MissionController extends BaseController
{
    /**
     * @var MissionRepositoryInterface
     */
    private $missionRepository;

    /**
     * @var MissionServiceInterface
     */
    private $missionService;

    /**
     * MissionController constructor.
     * @param MissionRepositoryInterface $missionRepository
     * @param MissionServiceInterface $missionService
     */
    public function __construct(
        MissionRepositoryInterface $missionRepository,
        MissionServiceInterface $missionService
    )
    {
        $this->missionRepository = $missionRepository;
        $this->missionService = $missionService;
    }

    /**
     *  All missions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (Auth::check()) {
            $response['data'] = $this->missionRepository->all();

            return $this->sendResponse($response, __('messages.successfulOperation'));
        } else {
            return $this->sendError(__('messages.unsuccessfulOperation'));
        }
    }

    /**
     *  Mission creation
     *
     * @param MissionRequests $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(MissionRequests $request)
    {
        $user = $request->user();
        $data = $request->only('name', 'description');
        $response['data'] = $this->missionService->createMission($user, $data);

        return $this->sendResponse($response, __('messages.successMission'));
    }

    /**
     * Show mission
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $response = $this->missionRepository->getById($id);

        return $this->sendResponse($response, __('messages.successMission'));
    }

    /**
     * Edit mission if you are its creator
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(int $id)
    {
        $response = $this->missionRepository->getById($id);
        $this->authorize('edit', $response);

        return $this->sendResponse($response, __('messages.successMission'));
    }

    /**
     * Update mission if you are its creator
     *
     * @param MissionRequests $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(MissionRequests $request, int $id)
    {
        $mission = $this->missionRepository->getById($id);
        $this->authorize('update', $mission);

        $mission->fill($request->all());
        $mission->save();
        $response['data'] = $mission;

        return $this->sendResponse($response, __('messages.successMission'));
    }

    /**
     * Delete mission if you are its creator
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $mission = $this->missionRepository->getById($id);
        $this->authorize('delete', $mission);
        $this->missionService->deleteMission($mission);

        return $this->sendResponse(null, __('messages.successMission'));
    }
}
