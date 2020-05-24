<?php

namespace Modules\Image\Services;

use Illuminate\Support\Facades\Storage;
use Modules\Image\Models\Image;
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
    public function create(User $user, $image)
    {
        if ($image !== null) {
            $user->images()->create(['image' => $image->store('public')]);
        }
    }


    /**
     * Delete avatar from the database and storage
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $image = Image::findOrFail($id);
        $image->delete();
        Storage::delete($image->image);
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
