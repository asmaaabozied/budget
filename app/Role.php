<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    // for tasks model permissions
    public function tasksPermissions()
    {
        return $this.permissions()->where('group', 'tasks_app');
    }
}
