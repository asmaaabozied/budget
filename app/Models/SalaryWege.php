<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SalaryWege extends Model
{
    //
    protected $table = 'salaries_wages';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id')->withDefault();
    }
}
