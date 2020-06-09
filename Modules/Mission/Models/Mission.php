<?php

namespace Modules\Mission\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Image\Models\Image;

class Mission extends Model
{
    /**
     * table name
     *
     * @var string
     */
    protected $table = 'missions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'content',
        'location',
        'language',
        'duration',
        'start',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
