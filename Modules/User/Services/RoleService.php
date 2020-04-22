<?php

namespace Modules\User\Services;

use Modules\User\Models\Role;
use Modules\User\Models\User;
use Modules\User\Services\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface
{
    public function assignRole(Role $role, User $user)
    {
        return $user->roles()->save($role);
    }
}
