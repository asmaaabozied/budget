<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tasks\Traits\SharedRelations;

/**
 * Class TasksStatusesHistory.
 */

/**
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class TasksUser extends Pivot
{
    use  SharedRelations,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = true;

    protected $table = 'task_user';

    protected $fillable = ['task_id', 'user_id', 'created_at', 'updated_at', 'deleted_at'];

    public function getModelLabel()
    {
        return $this->display_name;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('name', 'full_name', 'image_path');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id')->select('id', 'name', 'description');
    }
}
