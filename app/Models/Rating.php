<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employe_id')->withDefault();
    }
}
