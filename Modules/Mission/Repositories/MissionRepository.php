<?php

namespace Modules\Mission\Repositories;

use Modules\Mission\Builder\MissionQueryBuilder;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;


class MissionRepository extends MissionQueryBuilder implements MissionRepositoryInterface
{
    public function findMissionsByOwnerId(int $id = null)
    {
        if (empty($id)) {
            return null;
        }
        return $this->BuildMissionQuery($id)
            ->with('images')
            ->get();
    }
}
