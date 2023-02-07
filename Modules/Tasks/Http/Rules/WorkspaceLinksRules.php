<?php

namespace Modules\Tasks\Http\Rules;

class WorkspaceLinksRules
{
    public static function sharedRules(): array
    {
        return [
            'name' => 'required|string|min:6|max:70',
            'link' => 'required|url|min:6|max:140',
            'space_id' => 'required|numeric',
            'icon' => 'nullable|string',
            'icon_color' => 'nullable|string|max:7',
            'parent_id' => 'nullable|numeric',
            'notes' => 'nullable|string',
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
