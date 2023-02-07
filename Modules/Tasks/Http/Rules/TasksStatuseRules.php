<?php

namespace Modules\Tasks\Http\Rules;

class TasksStatuseRules
{
    public static function sharedRules(): array
    {
        return [
            'name' => 'required|string|min:2|max:20',
            'position' => 'nullable|numeric',
            'color' => 'nullable|string|max:7',
            'is_closed' => 'nullable|bool',
            'default' => 'nullable|bool',
            'company_id' => 'nullable|numeric',
            'space_id' => 'required|numeric',
        ];
    }

    public static function sharedMessages(): array
    {
        return [
            //            'name' => trans('tasks.labels.name'),
        ];
    }

    public static function sharedAttributes(): array
    {
        return [
            //            'name' => trans('tasks.labels.name'),
        ];
    }
}
