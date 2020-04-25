<?php

namespace Modules\Image\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['image'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
