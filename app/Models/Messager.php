<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Messager extends Model
{
    //
    protected $table = 'messagers';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
