<?php

namespace Modules\Tasks\Http\Rules;

class TasksWorkspaceRules
{
    public static function sharedRules(): array
    {
        return [
            'name' => 'required|string|min:6|max:70',
            'description' => 'required|string|min:12|max:200',
            'company_id' => 'sometimes|numeric',
            'branch_id' => 'sometimes|numeric',
            'users' => 'sometimes|array',
            'assign_all' => 'sometimes|bool',
        ];
    }

    public static function sharedMessages(): array
    {
        return [];
    }

    public static function sharedAttributes(): array
    {
        return [];
    }
}
