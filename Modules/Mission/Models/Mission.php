<?php

namespace Modules\Mission\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;

class Mission extends Model
{
    protected $table = 'missions';

    protected $fillable = ['user_id','name', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
