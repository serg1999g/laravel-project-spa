<?php

namespace Modules\User\Builder;


use Modules\User\Models\User;

class UserQueryBuilder
{
    protected function BuildUserQuery(int $id)
    {
        return User::where('id', $id);
    }

    protected function BuildAllUserQuery()
    {
        return User::all();
    }
}
