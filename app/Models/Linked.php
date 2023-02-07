<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Linked extends Model
{
    //
    protected $table = 'linkeds';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }
}
