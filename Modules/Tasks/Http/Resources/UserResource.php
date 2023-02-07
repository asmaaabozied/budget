<?php

namespace Modules\Tasks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'full_name' => $this->name.' '.$this->father_name.' '.$this->family_name,
            'email' => $this->email,
            'gender' => $this->type1,
            'type' => $this->types,
            'company_id' => $this->company_id,
            'project_id' => $this->project_id,
            'status' => $this->status,
            'phone' => $this->phone,
            // not needed currently , just need unread notifications
            //                'notifications'    => auth()->user()->Notifications(),
            //                'notifications_count'    => auth()->user()->Notifications()->count(),
            'unread_notifications' => auth()->user()->unreadNotifications(),
            'unread_notifications_count' => auth()->user()->unreadNotifications()->count(),
            'avatar' => asset('uploads/shops/profiles/'.$this->image),
            'roles' => array_map(
                function ($role) {
                    return $role['name'];
                }, $this->roles->toArray()),
            'permissions' => $this->allPermissions()->where('group', 'tasks_app')->pluck('id', 'name'),
            'ability' => [
                [
                    'action' => 'manage',
                    'subject' => 'all',
                ],
            ],

        ];
    }
}
