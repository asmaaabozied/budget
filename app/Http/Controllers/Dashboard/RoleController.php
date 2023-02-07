<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\RoleDatatables;
use App\Http\Controllers\Controller;
use App\Role;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class RoleController extends Controller
{
    /*----------------------------------------------------
     || Name     : show all roles                     |
     || Tested   : Done                                    |
     || using  : datatables                                      |
      ||                                    |
          -----------------------------------------------------*/
    public function index(RoleDatatables $roleDatatables)
    {
        if (auth()->user()->hasPermission('read_roles')) {
            return $roleDatatables->render('dashboard.datatable', [
                'title' => trans('site.roles'),
                'model' => 'roles',
                'count' => $roleDatatables->count(),
            ]);
        } else {
            session()->flash('success', __('site.notaccesspermisssions'));

            return redirect(url('/dashboard'));
        }
    }//end of index

    /*----------------------------------------------------
    || Name     : open pages create                     |
    || Tested   : Done                                    |
    ||                                     |
     ||                                    |
     -----------------------------------------------------*/

    public function create()
    {
//        if (auth()->user()->hasPermission('create_roles')) {

        $models = ['users', 'salaries', 'pages', 'linkeds', 'ratings', 'dailytasks', 'categories', 'roles', 'branches',
            'countries', 'cities', 'currencies', 'employee', 'LeaveAttendence',
        ];

        // TO DO , Customize tasks permissions
        $tasksModels = ['task', 'tasks_comments', 'tasks_statuse', 'tasks_workspace', 'workspace_links'];

        $tasksMaps = ['create', 'update', 'read', 'delete']; // because we will customize tasks permissions and add more like restore , force_delete ..etc

        $maps = ['create', 'update', 'read', 'delete'];

        $mapss = Mapss;

        return view('dashboard.roles.create', compact('models', 'maps', 'mapss', 'tasksModels', 'tasksMaps'));

//        } else {
//
//
//            session()->flash('success', __('site.notaccesspermisssions'));
//            return redirect(url('/dashboard'));
//        }
    }//end of create

    /*----------------------------------------------------
    || Name     : store data into database role          |
    || Tested   : Done                                    |
    ||                                     |
    ||                                    |
       -----------------------------------------------------*/

    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|unique:roles',
            'name' => 'required|unique:roles|max:255|regex:/^[a-zA-ZÑñ\s]+$/',
            'display_name' => 'required',
            //            'permissions' => 'required|min:1'
        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $role = role::create($request_data);

        if ($request->has('permissions') || $request->has('tasks_permissions')) {
            $all_permissions = array_merge($request->permissions, request('tasks_permissions', []));
            $role->syncPermissions($all_permissions);

        }
        if ($role) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.roles.index');

//            session()->flash('success', __('site.added_successfully'));
        }
//            DB::commit();
//        } catch (\Exception $e) {
//            ///Roll the db back if something happened
//            DB::rollback();
//            return response([
//                'status' => 'error',
//                // 'error' => $e->getMessage(),
//                'message' => trans('site.Try_again_something_went_wrong.'),
//            ], 500);
//        }
//        return back();
    }//end of store

    /*----------------------------------------------------
 || Name     : redirect to edit pages          |
 || Tested   : Done                                    |
 ||                                     |
||                                    |
  -----------------------------------------------------*/

    public function edit(role $role)
    {
//        if (auth()->user()->hasPermission('update_roles')) {

        $models = ['users', 'salaries', 'pages', 'linkeds', 'ratings', 'dailytasks', 'categories', 'roles', 'branches', 'countries', 'cities', 'currencies', 'employee', 'LeaveAttendence',
            'task', 'tasks_comments', 'tasks_statuse', 'tasks_workspace', 'workspace_links',
        ];

        $tasksModels = ['task', 'tasks_workspace', 'tasks_statuse', 'workspace_links', 'tasks_comments'];
        $maps = ['create', 'update', 'read', 'delete'];
        $mapss = Mapss;

        $tasksMaps = ['create', 'update', 'read', 'delete']; // because we will customize tasks permissions and add more like restore ,force_delete ..etc

        return view('dashboard.roles.edit', compact('role', 'models', 'maps', 'mapss', 'tasksModels', 'tasksMaps'));
//        } else {
//            session()->flash('success', __('site.notaccesspermisssions'));
//            return redirect(url('/dashboard'));
//
//        }
    }//end of role

    /*----------------------------------------------------
     || Name     : update data into database using roles        |
     || Tested   : Done                                    |
       ||                                     |
        ||                                    |
           -----------------------------------------------------*/

    public function update(Request $request, role $role)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^[a-zA-ZÑñ\s]+$/',

            'display_name' => 'required',
            //            'permissions' => 'required|min:1'
        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();

        $role->update($request_data);

        if ($request->has('permissions') || $request->has('tasks_permissions')) {
            $all_permissions = array_merge($request->permissions, request('tasks_permissions', []));
            $role->syncPermissions($all_permissions);

        }
        if ($role) {
            Alert::success('Success', __('site.updated_successfully'));
        } else {
            Alert::success('Success', __('site.update_faild'));

//            session()->flash('error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.roles.index');
//            DB::commit();
//        } catch (\Exception $e) {
//            ///Roll the db back if something happened
//            DB::rollback();
//            return response([
//                'status' => 'error',
//                // 'error' => $e->getMessage(),
//                'message' => trans('site.Try_again_something_went_wrong.'),
//            ], 500);
//        }
//        return back();
    }//end of update

    /*----------------------------------------------------
   || Name     : delete data into database using roles        |
   || Tested   : Done                                    |
   ||                                     |
   ||                                    |
     -----------------------------------------------------*/

    public function destroy(role $role)
    {
        if ($role->mandatory == true) {
            Alert::toast('NoDeleted', __('site.Notdeleted_successfully'));
        } else {
            $result = $role->delete();
            if ($result) {
                Alert::toast('Deleted', __('site.deleted_successfully'));
            } else {
                Alert::toast('Deleted', __('site.delete_faild'));
            }
        }

        return redirect()->route('dashboard.roles.index');
    }//end of destroy
}//end of controller
