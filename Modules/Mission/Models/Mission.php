<?php

namespace Modules\Mission\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Image\Models\Image;

class Mission extends Model
{
    protected $table = 'missions';

    protected $fillable = [
        'name', 'description'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
