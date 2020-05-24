<?php

namespace Modules\Mission\Builder;


use Modules\Mission\Models\Mission;


class MissionQueryBuilder
{
    protected function BuildMissionQuery(int $id)
    {
        return Mission::where('user_id', $id);
    }
}
