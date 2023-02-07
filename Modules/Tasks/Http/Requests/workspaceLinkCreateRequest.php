<?php

namespace Modules\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Rules\WorkspaceLinksRules;

class workspaceLinkCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        Auth::user()->load(['ownerWorkspaces', 'workspaces']);
        $isAuthorized = Auth::user()->ability(['Super Admin'], ['create_workspace_links'])
            || in_array($request->space_id, Auth::user()->ownerWorkspaces->pluck('id')->toArray());

        if ($isAuthorized) {
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

        return array_merge($rules, WorkspaceLinksRules::sharedRules());
    }

    public function attributes()
    {
        $attr = [];

        return array_merge($attr, WorkspaceLinksRules::sharedAttributes());
    }

    public function messages()
    {
        $msgs = [];

        return array_merge($msgs, WorkspaceLinksRules::sharedMessages());
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'created_by' => Auth::id(),
        ]);
    }
}
