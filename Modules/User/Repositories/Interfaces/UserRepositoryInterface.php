<?php

namespace Modules\User\Repositories\Interfaces;

use Modules\User\Models\User;

interface UserRepositoryInterface
{
    public function all();

    public function getByUser(int $id): User;
}
