<?php

namespace App;

use App\Models\Branch;
use App\Models\category;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;
use Modules\Tasks\Traits\UserTasksRelations;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Panoscape\History\HasOperations;
use RahulHaque\Filepond\Traits\HasFilepond;

class User extends Authenticatable
{
    use LaratrustUserTrait, HasApiTokens, Notifiable, HasFilepond,
        UserTasksRelations, HasOperations, HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['image_path'];
     protected $with = ['branches'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'email_verified_at' => 'phone_verified_at',
    ];

    public function isSuperAdmin()
    {
        return in_array('Super Admin', $this->getUserRolesAsArray());
    }

    public function isManger()
    {
        return in_array('manger', $this->getUserRolesAsArray());
    }

    public function isEmployeeManger()
    {
        return  $this->attributes['degree_job'] === 'manger';
    }

    public function getUserRolesAsArray()
    {
        return $this->roles->pluck('name')->toArray();
    }

    public function hasTwoFactore(): bool
    {
        return  $this->attributes['google2fa_secret'] ? true : false;
    }

    public function getImagePathAttribute()
    {
        return asset('images/employee/'.$this->image);
    }//end of get image path

    public function company()
    {
        return $this->belongsTo(Branch::class, 'company_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Branch::class, 'company_employee', 'employee_id', 'company_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Branch::class, 'project_employee', 'employee_id', 'project_id');
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_employee', 'employee_id', 'branch_id');
    }

    public function categories()
    {
        return $this->belongsToMany(category::class, 'category_employee', 'employee_id', 'category_id');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }
}//end of model
