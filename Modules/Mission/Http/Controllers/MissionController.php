<?php

namespace Modules\Mission\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Models\User;
use Modules\Mission\Http\Requests\MissionRequests;
use Modules\Mission\Models\Mission;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;

/**
 * Class MissionController
 * @package Modules\Mission\Http\Controllers
 */
class MissionController extends BaseController
{
    /**
     * @var $missionRepository
     */
    private $missionRepository;

    /**
     * MissionController constructor.
     * @param MissionRepositoryInterface $missionRepository
     */
    public function __construct(MissionRepositoryInterface $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    /**
     *  All missions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (Auth::check()) {
            $success['data'] = $this->missionRepository->all();

            return $this->sendResponse($success, __('messages.successfulOperation'));
        } else {
            return $this->sendError(__('messages.unsuccessfulOperation'));
        }
    }

    /**
     *  Mission creation
     *
     * @param MissionRequests $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(MissionRequests $request)
    {
        $user = Auth::user();
        $data = $request->only('name', 'description');
        $success['data'] = $user->missions()->create($data);

        return $this->sendResponse($success, __('messages.successMission'));
    }

    /**
     * Show mission
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $mission = $this->missionRepository->getById($id);

        return $this->sendResponse($mission, __('messages.successMission'));
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
        $mission = $this->missionRepository->getById($id);
        $this->authorize('edit', $mission);

        return $this->sendResponse($mission, __('messages.successMission'));
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
        $data['mission'] = $mission;

        return $this->sendResponse($data, __('messages.successMission'));
    }

    /**
     * Delete mission if you are its creator
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(int $id)
    {
        $mission = $this->missionRepository->getById($id);
        $this->authorize('delete', $mission);

        $this->missionRepository->delete($id);

        return $this->sendResponse(null, __('messages.successMission'));
    }
}
