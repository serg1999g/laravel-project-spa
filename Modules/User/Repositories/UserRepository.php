<?php

namespace Modules\User\Repositories;

use Modules\User\Builder\UserQueryBuilder;
use Modules\User\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends UserQueryBuilder implements UserRepositoryInterface
{
    /**
     * find User
     *
     * @param int|null $id
     * @return |null
     */
    public function findById(int $id = null)
    {
        if (empty($id)) {
            return null;
        }
        return $this->BuildUserQuery($id);
    }

    /**
     * find User with avatar
     *
     * @param int $id
     * @return mixed
     */
    public function findUserInfo(int $id)
    {
        return $this->findById($id)
            ->with('images')
            ->get();
    }
}
