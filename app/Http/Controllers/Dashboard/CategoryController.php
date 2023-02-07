<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\CategoryDatatables;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Response;

class CategoryController extends Controller
{
    /*----------------------------------------------------
|| Name     : show all categories                     |
 || Tested   : Done                                    |
   || using  : datatables                                      |
   ||                                    |
        -----------------------------------------------------*/
    public function index(CategoryDatatables $categoryDatatables)
    {
        if (auth()->user()->hasPermission('read_categories')) {
            return $categoryDatatables->render('dashboard.datatable', [
                'title' => trans('site.category'),
                'model' => 'categories',
                'count' => $categoryDatatables->count(),
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
        if (auth()->user()->hasPermission('create_categories')) {
            $categories = category::where('parent', null)->get();

            return view('dashboard.categories.create', compact('categories'));
        } else {
            session()->flash('success', __('site.notaccesspermisssions'));

            return redirect(url('/dashboard'));
        }
    }//end of create

    /*----------------------------------------------------
  || Name     : store data into database category          |
 || Tested   : Done                                    |
       ||                                     |
    ||                                    |
   -----------------------------------------------------*/

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'status' => 'required',
        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
//        $request_data['created_by'] = Auth()->user()->id;
        $category = category::create($request_data);

        if (isset($request->parent)) {
            $category->parent = $request->parent;
            $category->save();
        }
        if ($request->hasFile('image')) {
//                $thumbnail = $request->file('image');
//                $destinationPath = 'images/categories/';
//                $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
//                $thumbnail->move($destinationPath, $filename);
//                $category->image = $filename;
//                $category->save();
            UploadImage('images/categories', $category, $request);
        }
        if ($category) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.categories.index');
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

    public function edit($id)
    {
        if (auth()->user()->hasPermission('update_categories')) {
            $categories = category::all();
            $category = category::find($id);
            $category->user_name = User::where('id', $category->created_by)->first();

            return view('dashboard.categories.edit', compact('category', 'categories'));
        } else {
            session()->flash('success', __('site.notaccesspermisssions'));

            return redirect(url('/dashboard'));
        }
    }//end of edit

    /*----------------------------------------------------
    || Name     : update data into database using category        |
      || Tested   : Done                                    |
     ||                                     |
         ||                                    |
             -----------------------------------------------------*/

    public function update(Request $request, category $category)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'status' => 'required',
        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();

        $result = $category->update($request_data);
        if ($request->hasFile('image')) {
//                $thumbnail = $request->file('image');
//                $destinationPath = 'images/categories/';
//                $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
//                $thumbnail->move($destinationPath, $filename);
//                $category->image = $filename;
//                $category->save();
            UploadImage('images/categories', $category, $request);
        }
        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));
        } else {
            Alert::success('Success', __('site.update_faild'));

//            session()->flash('error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.categories.index');

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
    }

    /*----------------------------------------------------
    || Name     : delete data into database using banner        |
    || Tested   : Done                                    |
    ||                                     |
    ||                                    |
      -----------------------------------------------------*/

    public function destroy($id)
    {
        $category = category::find($id);
        $result = $category->delete();
        if ($category) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
