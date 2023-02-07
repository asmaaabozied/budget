<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
