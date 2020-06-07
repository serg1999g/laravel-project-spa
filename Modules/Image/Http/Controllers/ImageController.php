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
     * @return \PHPUnit\Util\Json
     */
    public function delete(int $id)
    {
        if (isset($id)){
            $this->imageUserService->delete($id);
        }

        return $this->respondWithMessage(__('messages.successfulOperation'));
    }
}
