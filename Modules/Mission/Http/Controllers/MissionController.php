<?php

namespace Modules\Mission\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Image\Models\Image;
use Modules\Mission\Http\Requests\MissionRequest;
use Modules\Mission\Models\Mission;
use Modules\User\Models\User;


class MissionController extends BaseController
{
    /**
     *  All missions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (Auth::check()) {
            $response = Mission::with('images')->get();

            return $this->sendResponse($response, __('messages.successfulOperation'));
        } else {
            return $this->sendError(__('messages.unsuccessfulOperation'));
        }
    }

    /**
     *  Mission creation
     *
     * @param MissionRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(MissionRequest $request)
    {
        $user = $request->user();

        $image = $request->file('image');

        $response = $user->missions()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'content'=>$request->input('content'),
        ]);
        $response->images()->create(['image' => $image->store('public')]);

        return $this->sendResponse($response, __('messages.successfulOperation'));
    }

    /**
     * Show mission
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $response = Mission::with('images')->where('id', $id)->get();

        return $this->sendResponse($response, __('messages.successfulOperation'));
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
        $response = Mission::findOrFail($id);
        $this->authorize('edit', $response);

        return $this->sendResponse($response, __('messages.successfulOperation'));
    }

    /**
     * Update mission if you are its creator
     *
     * @param MissionRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(MissionRequest $request, int $id)
    {
        $mission = Mission::findOrFail($id);
        $this->authorize('update', $mission);

        $mission->fill($request->all());
        $mission->save();
        $response = $mission;

        return $this->sendResponse($response, __('messages.successfulOperation'));
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
        $mission = Mission::findOrFail($id);
        $this->authorize('delete', $mission);
        $mission->delete();

        return $this->sendResponse(null, __('messages.successfulOperation'));
    }
}
