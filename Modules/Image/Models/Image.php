<?php

namespace Modules\Image\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * table name
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
