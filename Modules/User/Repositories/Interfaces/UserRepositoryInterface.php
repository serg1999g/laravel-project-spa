<?php

namespace Modules\User\Repositories\Interfaces;


interface UserRepositoryInterface
{
    public function findById(int $id);

    public function findUserInfo(int $id);
}
