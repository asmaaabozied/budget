<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Rules\TasksWorkspaceRules;

class TasksWorkspacesCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->ability(['Super Admin'], ['create_tasks_workspace'])) {
            return true;
        }
//        return false;
        abort(403, trans('tasks::responses.msg_by_code.403'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        return array_merge($rules, TasksWorkspaceRules::sharedRules());
    }

    public function attributes()
    {
        $attr = [];

        return array_merge($attr, TasksWorkspaceRules::sharedAttributes());
    }

    public function messages()
    {
        $msgs = [];

        return array_merge($msgs, TasksWorkspaceRules::sharedMessages());
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'created_by' => Auth::id(),
        ]);
    }
}
