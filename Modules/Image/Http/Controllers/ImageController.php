<?php

namespace Modules\Image\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        if (isset($id)){
            $this->imageUserService->delete($id);
        }

        return $this->sendResponse(null, __('messages.successfulOperation'));
    }
}
