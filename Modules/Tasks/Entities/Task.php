<?php

namespace Modules\Tasks\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tasks\Entities\Scopes\NewestFirst;
use Modules\Tasks\Traits\Historyable;
use Modules\Tasks\Traits\SharedRelations;
use Modules\Tasks\Traits\TaskRelations;
use Panoscape\History\HasHistories;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property int $owner_id
 * @property int $status_id
 * @property int $space_id
 * @property int $company_id
 * @property int $branch_id
 * @property int $created_by
 * @property int $edited_by
 * @property string $name
 * @property string $description
 * @property string $expected_time
 * @property string $total_time
 * @property string $priority
 * @property int $order
 * @property int $progress
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Branch $branch
 * @property TasksWorkspace $tasksWorkspace
 * @property TasksStatus $tasksStatus
 * @property User $user
 * @property User $creator
 * @property User $editor
 * @property TasksTimer[] $tasksTimers
 */
class Task extends Model implements HasMedia
{
    use TaskRelations, SharedRelations, SoftDeletes,InteractsWithMedia,
        HasHistories, Historyable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'owner_id', 'status_id', 'space_id', 'company_id', 'branch_id', 'created_by', 'edited_by', 'name', 'description', 'expected_time', 'total_time', 'priority', 'order', 'progress', 'expiry_time', 'slug', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['mediaFullUrls'];

    public function getModelLabel()
    {
        return $this->display_name;
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new NewestFirst);
    }

    // all relationships for Tasks model in Modules/Tasks/Traits/TaskRelations.php

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('tasks-media');
        //add options
    }

    public function getMediaFullUrlsAttribute()
    {
        $newArr = [];
        foreach ($this->media as $media) {
            array_push($newArr, $media->getFullUrl());
        }

        return $newArr;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
