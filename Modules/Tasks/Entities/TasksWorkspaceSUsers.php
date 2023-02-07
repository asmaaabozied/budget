<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TasksWorkspaceSUsers.
 */
class TasksWorkspaceSUsers extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tasks_workspaces_users';

    protected $fillable = ['space_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

    public function getModelLabel()
    {
        return $this->display_name;
    }
}
