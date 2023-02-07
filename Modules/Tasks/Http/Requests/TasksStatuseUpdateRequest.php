<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Rules\TasksStatuseRules;

class TasksStatuseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->ability(['Super Admin', 'manger'], ['update_tasks_statuse'])
            || Auth::user()->isEmployeeManger()
        ) {
            return true;
        }
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

        return array_merge($rules, TasksStatuseRules::sharedRules());
    }

    public function attributes()
    {
        $attr = [];

        return array_merge($attr, TasksStatuseRules::sharedAttributes());
    }

    public function messages()
    {
        $msgs = [];

        return array_merge($msgs, TasksStatuseRules::sharedMessages());
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'edited_by' => Auth::id(),
        ]);
    }
}
