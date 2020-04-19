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

    public function index()
    {
        // TODO
        $mission['data'] = $this->missionRepository->all();

        return $this->sendResponse($mission, 'all');
    }

    public function create(MissionRequests $request)
    {
        $user = Auth::user();
        $credentials = $request->only('name', 'description');

        $mission = $user->missions()->create($credentials);
        $success['mission'] = $mission;

        return $this->sendResponse($success, 'create');
    }

    public function update($id)
    {
        // TODO
        $mission = $this->missionRepository->getById($id);
    }

    public function delete($id)
    {
        // TODO
        $mission = $this->missionRepository->delete($id);

        return $this->sendResponse($mission, 'delete');
    }
}
