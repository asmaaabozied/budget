<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tasks\Traits\SharedRelations;

/**
 * Class TasksStatusesHistory.
 */

/**
 * @property int $id
 * @property int $task_id
 * @property int $tasks_statuses_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class TasksStatusesHistory extends Model
{
    use  SharedRelations, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tasks_statuses_histories';

    protected $fillable = ['task_id', 'tasks_statuses_id', 'created_at', 'updated_at', 'deleted_at'];
}
