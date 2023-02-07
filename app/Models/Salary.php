<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //

    protected $table = 'salaries';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }
}
