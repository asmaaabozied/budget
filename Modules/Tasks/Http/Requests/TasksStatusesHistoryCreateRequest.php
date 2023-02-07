<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Tasks\Http\Rules\TaskRules;

class TasksStatusesHistoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        return array_merge($rules, TaskRules::sharedRules());
    }

    public function attributes()
    {
        $attr = [];

        return array_merge($attr, TaskRules::sharedAttributes());
    }

    public function messages()
    {
        $msgs = [];

        return array_merge($msgs, TaskRules::sharedMessages());
    }

//    protected function prepareForValidation()
//    {
//    }
}
