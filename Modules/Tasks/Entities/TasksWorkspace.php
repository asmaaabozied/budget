<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tasks\Traits\SharedRelations;
use Panoscape\History\HasHistories;

/**
 * Class TasksWorkspaces.
 */

/**
 * @property int $id
 * @property int $company_id
 * @property int $branch_id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Task[] $tasks
 * @property User[] $users
 * @property Company $company
 * @property Branch $branch
 */
class TasksWorkspace extends Model
{
    use  SharedRelations, SoftDeletes,HasHistories;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['company_id', 'branch_id', 'name', 'created_by', 'edited_by', 'description', 'created_at', 'updated_at', 'deleted_at'];

    public function getModelLabel()
    {
        return $this->display_name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allTasks()
    {
        // we still need this relation to some cases, some tasks have not status or but in space without status,, or in tasks pool
        return $this->hasMany(Task::class, 'space_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasksPool()
    {
        // we still need this relation to some cases, some tasks have not status or but in space without status,, or in tasks pool
        return $this->allTasks()->whereNull('status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses()
    {  // statuses assigned to this workspace ,, we will have custom statuses for every workspace
        return $this->hasMany(TasksStatuse::class, 'space_id', 'id')->orderBy('position', 'ASC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany(WorkspaceLink::class, 'space_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'tasks_workspaces_users', 'space_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

//    public function company()
//    {
//        return $this->belongsTo(Company::class, 'company_id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
