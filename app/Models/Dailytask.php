<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Dailytask extends Model
{
    protected $table = 'dailytasks';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }
}
