<?php

namespace Modules\Mission\Repositories\Interfaces;

use Modules\Mission\Models\Mission;

interface MissionRepositoryInterface
{
    public function all();

    public function getById($id): Mission;

    public function delete($id): Mission;
}
