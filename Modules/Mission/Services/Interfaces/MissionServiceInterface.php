<?php

namespace Modules\Mission\Services\Interfaces;


use Modules\User\Models\User;

interface MissionServiceInterface
{
    public function createMission(User $user, $mission);

    public function deleteMission($mission): bool;
}
