<?php

namespace Modules\Tasks\Traits;

//use Modules\Tasks\Entities\Company;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\TasksWorkspace;
use Modules\Tasks\Entities\User;

trait UserTasksRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    { // assigned tasks
        return $this->belongsToMany(Task::class, 'task_user', 'user_id', 'task_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownerTasks()
    { // his own tasks
        return $this->hasMany(Task::class, 'created_by', 'id');
    }

    public function allUserTasks()
    {
        $ownTasks = collect($this->tasks);
        $allTasks = $ownTasks->merge($this->ownerTasks);
        $allTasks->all();

        return $allTasks;
    }

    public function allUserTasksIds()
    {
        return $this->allUserTasks()->pluck('id');
    }

    public function allUserTasksIdsAsArray()
    {
        return $this->allUserTasksIds()->toArray();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workspaces()
    { // assigned workspaces
        return $this->belongsToMany(TasksWorkspace::class, 'tasks_workspaces_users', 'user_id', 'space_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownerWorkspaces()
    { // his own workspaces
        return $this->hasMany(TasksWorkspace::class, 'created_by', 'id');
        // ->whereType('private');
    }

    public function allUserWorkspaces()
    {
        $ownSpaces = collect($this->ownerWorkspaces);
        $allSpaces = $ownSpaces->merge($this->workspaces);
        $allSpaces->all();

        return $allSpaces;
    }

    public function allUserWorkspacesIds()
    { // will used common in many places to verify user permissioins and abilities
        return $this->allUserWorkspaces()->pluck('id');
    }

    public function allUserWorkspacesIdsAsArray()
    { // will used common in many places to verify user permissioins and abilities
        return $this->allUserWorkspacesIds()->toArray();
    }
}
