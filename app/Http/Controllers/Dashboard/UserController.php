<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\UserDatatables;
use App\Http\Controllers\Controller;
use App\Role;
use App\Services\TwoFactorService;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /*----------------------------------------------------
      || Name     : show all users                     |
      || Tested   : Done                                    |
      || using  : datatables                                      |
       ||                                    |
           -----------------------------------------------------*/

    public function index(UserDatatables $userDatatables)
    {
        if (auth()->user()->hasPermission('read_users')) {
            return $userDatatables->render('dashboard.datatable', [
                'title' => trans('site.users'),
                'model' => 'users',
                'count' => $userDatatables->count(),
            ]);
        } else {
            session()->flash('success', __('site.notaccesspermisssions'));

            return redirect(url('/dashboard'));
        }
    }//end of index

    /*----------------------------------------------------
         || Name     : open pages show using id                     |
         || Tested   : Done                                    |
         ||                                     |
          ||                                    |
          -----------------------------------------------------*/

    public function show($id)
    {
        // if (auth()->user()->hasPermission('read_users')) {

        $user = User::find($id);

        $roles = Role::all();

        return view('dashboard.users.show', compact('user', 'roles'));
        // } else {

        //     session()->flash('success', __('site.notaccesspermisssions'));
        //     return redirect(url('/dashboard'));
        // }
    }

    public function showshop($id)
    {
    }

    /*----------------------------------------------------
        || Name     : open pages create                     |
        || Tested   : Done                                    |
        ||                                     |
         ||                                    |
         -----------------------------------------------------*/

    public function create()
    {
        // if (auth()->user()->hasPermission('create_users')) {

        $roles = Role::all();

        return view('dashboard.users.create', compact('roles'));
        // } else {
        //     session()->flash('success', __('site.notaccesspermisssions'));
        //     return redirect(url('/dashboard'));

        // }
    }//end of create

    /*----------------------------------------------------
        || Name     : SaveShopUser         |
        || Tested   : Done                                    |
        ||                                     |
        ||                                    |
           -----------------------------------------------------*/

    /*----------------------------------------------------
      || Name     : store data into database users          |
      || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function store(Request $request)
    {
        $request->validate([

            'email' => 'required|email|string|unique:users',
            'phone' => 'required|string|unique:users',

            //            'password' => 'required',
            'password' => 'required|confirmed',
            //            'roles' => 'required'
        ],
            [
                'password.regex' => __('site.password_regex'),
                //                'roles.required' => __("site.roles_required"),
            ]
        );

//
//        DB::beginTransaction();
//        try {
        $request_data = $request->except(['password_confirmation', 'permissions', 'roles', 'image']);

        // To Make User Active
        $request_data['status'] = 1;
        $request_data['types'] = 'User';

        $request_data['password'] = bcrypt($request->password);
        $request_data['user_id'] = Auth::id();
        $user = User::create($request_data);

//             if ($request->hasFile('image')) {
        // //                $thumbnail = $request->file('image');
        // //                $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
        // //                Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
        // //                $user->image = $filename;
        // //                $user->save();

//                 UploadImage('images/employee/',$user,$request);
//             }

        if ($request->hasFile('image')) {
            $thumbnail = $request->file('image');
            $destinationPath = 'images/employee/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath, $filename);
            $user->image = $filename;
            $user->save();
        }

        if ($request->roles) {
            // $user->attachRole('admin');
            $user->syncRoles($request->roles);
        }

        if ($user) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.users.index');

//            session()->flash('success', __('site.added_successfully'));
        }
//            DB::commit();
    }//end of store

    /*----------------------------------------------------
      || Name     : redirect to edit pages          |
      || Tested   : Done                                    |
      ||                                     |
     ||                                    |
       -----------------------------------------------------*/

    public function edit($id)
    {
        $roles = Role::all();

        if (auth()->user()->hasRole('Super Admin')) {
            $user = User::find($id);

            return view('dashboard.users.edit', compact('user', 'roles'));
        } elseif ($id == Auth::id()) {
            $user = User::find(Auth::id());

            return view('dashboard.users.edit', compact('user', 'roles'));
        } else {
            Alert::success('Success', __('site.notaccesspermisssions'));

            return redirect(url('/ar/dashboard'));
        }
    }//end of user

    /*----------------------------------------------------
     || Name     : update data into database using users        |
     || Tested   : Done                                    |
       ||                                     |
        ||                                    |
           -----------------------------------------------------*/

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', Rule::unique('users')->ignore($user->id)],
            // 'password' => 'nullable|confirmed',

        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->except(['permissions', 'roles', 'password_confirmation']);
        if (! empty($request->password)) {
            $request_data['password'] = bcrypt($request->password);
        } else {
            $request_data = $request->except(['permissions', 'roles', 'password', 'password_confirmation']);
        }

        $user->update($request_data);
//             if ($request->hasFile('image')) {
        // //                $thumbnail = $request->file('image');
        // //                $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
        // //                Image::make($thumbnail)->resize(100, 100)->save(public_path('/uploads/' . $filename));
        // //                $user->image = $filename;
        // //                $user->save();

//                 UploadImage('images/employee/',$user,$request);
//             }

        if ($request->hasFile('image')) {
            $thumbnail = $request->file('image');
            $destinationPath = 'images/employee/';
            $filename = time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath, $filename);
            $user->image = $filename;
            $user->save();
        }

        if (isset($request->roles)) {
            $user->syncRoles($request->roles);
        }
        if ($user) {
            Alert::success('Success', __('site.updated_successfully'));

            //   return redirect()->route('dashboard.users.index');
            return back();
//            session()->flash('success', __('site.updated_successfully'));
        } else {
            Alert::success('Success', __('site.update_faild'));

            return redirect()->route('dashboard.users.index');

//            session()->flash('error', __('site.update_faild'));
        }
    }//end of update

    /*----------------------------------------------------
 || Name     : delete data into database using users        |
 || Tested   : Done                                    |
 ||                                     |
 ||                                    |
   -----------------------------------------------------*/

    public function destroy(User $user)
    {
        if ($user->id == 1) {
            flash(__('site.Notdeleted_successfully'))->success();

//            session()->flash('success', __('site.Notdeleted_successfully'));
            return back();
        } else {
            $result = $user->delete();
            if ($result) {
                Alert::toast('Success', __('site.deleted_successfully'));
            } else {
                Alert::toast('Success', __('site.delete_faild'));

//                session()->flash('error', __('site.delete_faild'));
            }

            return back();
        }
    }//end of destroy

    /*----------------------------------------------------
  || Name     : active or block  data into database using roles        |
  || Tested   : Done                                    |
  ||                                     |
  ||                                    |
    -----------------------------------------------------*/
    public function block($user_id)
    {
        $info = User::find($user_id);
        $status = ($info->status == 0) ? 1 : 0;
        $info->status = $status;
        $info->save();

        Alert::toast('Success', __('site.updated_successfully'));

        return back();

        //Revoke User With Status =0;
        if ($status == 0) {
            DB::table('oauth_access_tokens')
                ->where('user_id', $user_id)
                ->delete();
        }
    }//end of update

    public function logout(TwoFactorService $twoFactorService)
    {
        $twoFactorService->destroyUserSession();
        Auth::logout();

        return back();
    }
}
