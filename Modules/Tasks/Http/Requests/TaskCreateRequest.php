<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Rules\TaskRules;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        if (Auth::user()->ability(['Super Admin', 'manger'], ['create_task'])
           || Auth::user()->isEmployeeManger()
         || in_array($request->space_id, Auth::user()->allUserWorkspacesIdsAsArray())
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

    protected function prepareForValidation()
    {
        $this->merge([
            'created_by' => auth()->user()->id,
            'owner_id' => auth()->user()->id
        ]);
    }
}
