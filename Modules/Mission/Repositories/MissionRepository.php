<?php

namespace Modules\Mission\Repositories;

use Modules\Mission\Models\Mission;
use Modules\Mission\Repositories\Interfaces\MissionRepositoryInterface;


class MissionRepository implements MissionRepositoryInterface
{
    public function all()
    {
        return Mission::all();
    }

    public function getById(int $id): Mission
    {
        return Mission::findOrFail($id);
    }
}
