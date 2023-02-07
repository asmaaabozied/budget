<?php

namespace Modules\Tasks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tasks\Traits\SharedRelations;

/**
 * Class WorkspaceLink.
 */
class WorkspaceLink extends Model
{
    use SoftDeletes, SharedRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $keyType = 'integer';

    protected $fillable = ['name', 'link', 'icon', 'icon_color', 'space_id', 'parent_id', 'created_by', 'edited_by'];

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
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subLinks()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
