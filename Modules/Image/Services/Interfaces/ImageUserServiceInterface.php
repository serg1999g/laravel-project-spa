<?php

namespace Modules\Image\Services\Interfaces;

use Modules\User\Models\User;

interface ImageUserServiceInterface
{
    public function create(User $user, $image);
}
