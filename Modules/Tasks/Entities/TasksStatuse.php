<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Modules\Tasks\Entities\Company;
use Modules\Tasks\Traits\SharedRelations;
use Modules\Tasks\Entities\Task;

/**
 * @property int $id
 * @property int $company_id
 * @property int $created_by
 * @property int $edited_by
 * @property string $title
 * @property int $position
 * @property string $color
 * @property bool $is_closed
 * @property bool $default
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Task[] $tasks
 * @property Branch $branch
 * @property User $creator
 * @property User $editor
 */
class TasksStatuse extends Model
{
    use  SharedRelations,SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'space_id', 'created_by', 'edited_by', 'name', 'position', 'color', 'is_closed', 'default', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['tasks_count'];

    public function getModelLabel()
    {
        return $this->display_name;
    }

    public function getTasksCountAttribute()
    {
        return $this->tasks->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workspace()
    {
        return $this->belongsTo(TasksWorkspace::class, 'space_id');
    }

    //    public function company()
//    {
//        return $this->belongsTo(Company::class, 'company_id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo('Modules\Tasks\Entities\Branch', 'company_id');
    }
}
