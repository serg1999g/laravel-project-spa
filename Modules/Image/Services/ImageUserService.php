<?php

namespace Modules\Image\Services;

use Illuminate\Support\Facades\Storage;
use Modules\User\Models\User;
use Modules\Image\Services\Interfaces\ImageUserServiceInterface;


class ImageUserService implements ImageUserServiceInterface
{
    public function create(User $user, $image)
    {
        return $user->images()->create(['image' => $image->store('public')]);
    }

    // TODO refactoring
    public function delete(User $user)
    {
        $user->images()->delete();
        Storage::delete($user->id);
    }
}
