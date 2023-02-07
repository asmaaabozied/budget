<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    public $timestamps = true;

    protected $fillable = ['imageable_id', 'imageable_type', 'image', 'name', 'end_date'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
