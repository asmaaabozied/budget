<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
