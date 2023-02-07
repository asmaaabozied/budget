<?php

namespace Modules\Tasks\Http\Rules;

class TasksCommentRules
{
    public static function sharedRules(): array
    {
        return [
            'content' => 'required|string|min:2|max:500',
            'task_id' => 'required|numeric',
            //            'user_id'	=>'required|numeric',
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
