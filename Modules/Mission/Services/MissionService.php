<?php

namespace Modules\Mission\Services;

use Modules\Mission\Services\Interfaces\MissionServiceInterface;
use Modules\User\Models\User;


class MissionService implements MissionServiceInterface
{
    public function createMission(User $user, $mission)
    {
        return $user->missions()->create($mission);
    }

    public function deleteMission($mission): bool
    {
        return $mission->delete();
    }
}
