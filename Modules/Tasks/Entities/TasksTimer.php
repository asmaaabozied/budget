<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tasks\Traits\SharedRelations;

/**
 * Class TasksTimer.
 */
/**
 * @property int $id
 * @property int $task_id
 * @property int $user_id
 * @property string $started_at
 * @property string $stopped_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Task $task
 * @property User $user
 */
class TasksTimer extends Model
{
    use  SharedRelations, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['task_id', 'user_id', 'started_at', 'stopped_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(tasks::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
