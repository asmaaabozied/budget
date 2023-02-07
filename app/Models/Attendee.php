<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $table = 'attendees';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }
}
