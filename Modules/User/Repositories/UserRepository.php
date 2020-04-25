<?php

namespace Modules\User\Repositories;

use Modules\User\Models\User;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function getByUser(int $id): User
    {
        return User::findOrFail($id);
    }
}
