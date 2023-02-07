<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    //

    protected $table = 'rewards';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
