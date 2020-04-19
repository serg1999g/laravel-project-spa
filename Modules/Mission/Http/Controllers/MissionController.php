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

            return $this->sendResponse($success, 'all');
        } else {
            return $this->sendError('lox');
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
     * @param $id
     */
    public function update($id)
    {
        // TODO
        $mission = $this->missionRepository->getById($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        // TODO
        $mission = $this->missionRepository->delete($id);

        return $this->sendResponse($mission, 'delete');
    }
}
