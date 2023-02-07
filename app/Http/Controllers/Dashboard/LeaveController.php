<?php

namespace App\Http\Controllers\Dashboard;


use Alert;


use App\DataTables\leaveDataTable;
use App\Models\leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Lang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Response;
use DB;

class LeaveController extends Controller
{


    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(leaveDataTable $dataTable)
    {


        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.leaves'),
            'model' => 'leaves',
            'count' => $dataTable->count()
        ]);


    }//end of index


    /*----------------------------------------------------
    || Name     : open pages create                     |
    || Tested   : Done                                    |
    ||                                     |
    ||                                    |
    -----------------------------------------------------*/

    public function create()
    {

        $dt = Carbon::now();
        $time = $dt->toTimeString();
        $date= $dt->format('Y-m-d') ;

        return view('dashboard.leaves.create', compact('time','date'));


    }//end of create


    /*----------------------------------------------------
    || Name     : store data into database branches          |
      || Tested   : Done                                    |
         ||                                     |
       ||                                    |
        -----------------------------------------------------*/

    public function store(Request $request)
    {
        $request->validate([
//            'period_id' => 'required',
            'hour' => 'required',
//            'description_en' => 'required|min:5',
            'description_ar' => 'required|min:5',


        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $reason = leave::create($request_data);


        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));


            return redirect()->route('dashboard.leaves.index');


        }


    }//end of store


    /*----------------------------------------------------
    || Name     : redirect to edit pages          |
   || Tested   : Done                                    |
    ||                                     |
    ||                                    |
       -----------------------------------------------------*/

    public function edit($id)
    {


        $leave = leave::find($id);
        return view('dashboard.leaves.edit', compact('leave'));

    }//end of edit

    public function show($id)
    {


        $leave = leave::find($id);
        return view('dashboard.leaves.show', compact('leave'));

    }//end of edit


    /*----------------------------------------------------
     || Name     : update data into database using banner        |
       || Tested   : Done                                    |
            ||                                     |
                ||                                    |
        -----------------------------------------------------*/


    public function update(Request $request, $id)
    {
        $request->validate([
//            'period_name' => 'required',
            'hour' => 'required',


        ]);
//        DB::beginTransaction();
//        try {
        $leaves = leave::find($id);

        $request_data = $request->all();

        $result = $leaves->update($request_data);


        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));


            return redirect()->route('dashboard.leaves.index');

        } else {
            Alert::success('Error', __('site.update_faild'));


        }
        return redirect()->route('dashboard.leaves.index');

    }


    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $reason = leave::find($id);
        $result = $reason->delete();
        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));


        } else {
            Alert::error('Error', __('site.delete_faild'));


        }
        return back();
    }


}//end of controller
