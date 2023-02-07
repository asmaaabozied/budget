<?php

namespace Modules\Tasks\Http\Rules;

class TasksTimerRules
{
    public static function sharedRules(): array
    {
        return [
            'task_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'started_at' => 'required|date_format:H:i:s',
            'stopped_at' => 'required|date_format:H:i:s',
        ];
    }

    public static function sharedMessages(): array
    {
        return [
            'name' => trans('tasks.labels.email'),
        ];
    }

    public static function sharedAttributes(): array
    {
        return [
            'name' => trans('tasks.labels.email'),
        ];
    }
}
