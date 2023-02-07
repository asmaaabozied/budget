<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Rules\TasksCommentRules;

class TasksCommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // just super admin and managers and any user has update_tasks_comments permission can create comment
        // also every user can create comment for any task he assigned to it or his own tasks
        if (Auth::user()->ability(['Super Admin', 'manger'], ['update_tasks_comments'])
                || Auth::user()->isEmployeeManger()
                || in_array(request()->task_id, Auth::user()->allUserTasksIdsAsArray())) {
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

        return array_merge($rules, TasksCommentRules::sharedRules());
    }

    public function attributes()
    {
        $attr = [];

        return array_merge($attr, TasksCommentRules::sharedAttributes());
    }

    public function messages()
    {
        $msgs = [];

        return array_merge($msgs, TasksCommentRules::sharedMessages());
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::id(),
        ]);
    }
}
