<?php

namespace Modules\Image\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\Image\Http\Requests\ImageRequest;
use Modules\Image\Http\Resources\ImageResource;
use Modules\Image\Services\Interfaces\ImageUserServiceInterface;

class ImageController extends BaseController
{

    /**
     * @var ImageUserServiceInterface
     */
    protected $imageUserService;

    /**
     * ImageController constructor.
     * @param ImageUserServiceInterface $imageUserService
     */
    public function __construct(ImageUserServiceInterface $imageUserService)
    {
        $this->imageUserService = $imageUserService;
    }

    /**
     * delete image
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        if (isset($id)) {
            $this->imageUserService->delete($id);
        }

        return $this->sendResponse(null, __('messages.successfulOperation'));
    }

    /**
     * create user avatar
     *
     * @param ImageRequest $request
     * @return mixed
     */
    public function create(ImageRequest $request)
    {
        $user = $request->user();
        $image = $request->file('image');

        if ($request->has('image')) {
            if ($image !== null && isset($image)) {
                $imageName = rand() . $image->getClientOriginalName();
                $image->move(public_path('storage'), $imageName);

                $user->images()->create(['image' => $imageName]);
            }
        }
        $response = ImageResource::make($user->images);

        return $this->respondWithArray(['data' => $response]);
    }

    public function createImages(ImageRequest $request)
    {
        $user = $request->user();
        $image = $request->file('image');

        if ($request->has('image')) {
            if ($image !== null && isset($image)) {
                $imageName = rand() . $image->getClientOriginalName();
                $image->move(public_path('storage'), $imageName);

                $user->missions()->images()->create(['image' => $imageName]);
            }
        }
        $response = ImageResource::make($user->images);

        return $this->respondWithArray(['data' => $response]);
    }
}
