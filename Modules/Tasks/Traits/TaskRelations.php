<?php

namespace Modules\Tasks\Traits;

//use Modules\Tasks\Entities\Company;
use Modules\Tasks\Entities\Branch;
use Modules\Tasks\Entities\TasksComment;
use Modules\Tasks\Entities\TasksStatuse;
use Modules\Tasks\Entities\TasksStatusesHistory;
use Modules\Tasks\Entities\TasksWorkspace;
use Modules\Tasks\Entities\User;

trait TaskRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function company()
//    {
//        return $this->belongsTo(Company::class, 'company_id');
//    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workspace()
    {
        return $this->belongsTo(TasksWorkspace::class, 'space_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(TasksStatuse::class, 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statusesHistories()
    {
        return $this->hasMany(TasksStatusesHistory::class, 'task_id')->orderBy('id', 'ASC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany(self::class, 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(TasksComment::class)->whereNull('parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Timers()
    {
        return $this->hasMany(TasksTimer::class);
    }
}
