<?php

namespace Modules\Image\Services;

use Modules\User\Models\User;
use Modules\Image\Services\Interfaces\ImageUserServiceInterface;


class ImageUserService implements ImageUserServiceInterface
{
    public function create(User $user, $image)
    {
        return $user->images()->create(['image' => $image->store('public')]);
    }
}
