<?php

namespace Modules\Image\Services;

use Illuminate\Support\Facades\Storage;
use Modules\User\Models\User;
use Modules\Image\Services\Interfaces\ImageUserServiceInterface;


class ImageUserService implements ImageUserServiceInterface
{
    /**
     * Create avatar for the user and add a picture to the storage
     *
     * @param User $user
     * @param string $image
     */
    public function create(User $user, string $image)
    {
        if ($image !== null) {
            $user->images()->create(['image' => $image->store('public')]);
        }
    }

    // TODO

    /**
     * Delete avatar from the database and storage
     *
     * @param User $user
     */
    public function delete(User $user)
    {
        $user->images()->delete();
        Storage::delete($user->id);
    }

    /**
     * Update avatar. Delete current
     *
     * @param User $user
     */
    public function update(User $user)
    {
        // TODO
    }
}
