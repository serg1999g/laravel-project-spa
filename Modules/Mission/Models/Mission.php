<?php

namespace Modules\Mission\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;

class Mission extends Model
{
    protected $table = 'missions';

    protected $fillable = [
        'name', 'description'
    ];
}
