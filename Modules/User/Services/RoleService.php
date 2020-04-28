<?php

namespace Modules\User\Services;

use Modules\User\Models\Role;
use Modules\User\Models\User;
use Modules\User\Services\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface
{
    /**
     * assign role to user
     *
     * @param Role $role
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function assignRole(Role $role, User $user)
    {
        return $user->roles()->save($role);
    }
}
