<?php

namespace Modules\Tasks\Http\Rules;

class TaskRules
{
    public static function sharedRules(): array
    {
        return [
            'name' => 'required|string|min:6|max:70',
            'description' => 'required|min:12|max:5000',
            'expected_time' => 'sometimes|numeric',
            'priority' => 'sometimes|string',
            'order' => 'sometimes|numeric',
            'progress' => 'sometimes|numeric',
            'status_id' => 'required|numeric',
            'space_id' => 'sometimes|numeric',
            'company_id' => 'sometimes|numeric',
            'parent_id' => 'sometimes|numeric',
            'branch_id' => 'sometimes|numeric',
            'users' => 'sometimes|array',
            'assign_all' => 'sometimes|bool',
            'expiry_time' => 'nullable|date',
        ];
    }

    public static function sharedMessages(): array
    {
        return [
            //               'name' => trans('tasks.labels.email'),
        ];
    }

    public static function sharedAttributes(): array
    {
        return [
            //            'name' => trans('tasks.labels.email'),
        ];
    }
}
