<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    protected $guarded = [];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
