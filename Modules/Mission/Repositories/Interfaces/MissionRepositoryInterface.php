<?php

namespace Modules\Mission\Repositories\Interfaces;

use Modules\Mission\Models\Mission;

interface MissionRepositoryInterface
{
    public function findMissionsByOwnerId(int $id);
//    public function all();
//
//    public function getById(int $id): Mission;
}
