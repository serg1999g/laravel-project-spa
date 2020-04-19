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

    public function getById($id): Mission
    {
        return Mission::findOrFail($id);
    }

    public function delete($id): Mission
    {
        return Mission::findOrFail($id)->delete();
    }
}
