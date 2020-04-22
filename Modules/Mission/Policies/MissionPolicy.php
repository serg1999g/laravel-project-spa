<?php

namespace Modules\Mission\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Models\User;
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
        //
    }

    /**
     * @param User $user
     * @param Mission $mission
     * @return bool
     */
    public function update(User $user, Mission $mission)
    {
        return $user->id === $mission->user_id;
    }

    /**
     * @param User $user
     * @param Mission $mission
     * @return bool
     */
    public function delete(User $user, Mission $mission)
    {
        return $user->id === $mission->user_id;
    }

    /**
     * @param User $user
     * @param Mission $mission
     * @return bool
     */
    public function edit(User $user, Mission $mission)
    {
        return $user->id === $mission->user_id;
    }

}
