<?php

namespace Modules\Mission\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Auth\Models\User;
use Modules\Mission\Models\Mission;

class MissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function update(User $user, Mission $mission)
    {
        return $user->id === $mission->user_id;
    }

    public function delete(User $user, Mission $mission)
    {
        return $user->id === $mission->user_id;
    }

    public function edit(User $user, Mission $mission)
    {
        return $user->id === $mission->user_id;
    }

}
