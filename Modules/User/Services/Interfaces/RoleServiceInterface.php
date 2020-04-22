<?php

namespace Modules\User\Services\Interfaces;

use Modules\User\Models\Role;
use Modules\User\Models\User;

interface RoleServiceInterface
{
    public function assignRole(Role $role, User $user);
}
