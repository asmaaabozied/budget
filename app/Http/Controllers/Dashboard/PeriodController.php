<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\PeriodsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Period;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Response;

class PeriodController extends Controller
{
    /*----------------------------------------------------
|| Name     : show all categories                     |
 || Tested   : Done                                    |
   || using  : datatables                                      |
   ||                                    |
        -----------------------------------------------------*/
    public function index(PeriodsDataTable $periodsDataTable)
    {
        return $periodsDataTable->render('dashboard.datatable', [
            'title' => trans('site.periods'),
            'model' => 'periods',
            'count' => $periodsDataTable->count(),
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
        return view('dashboard.periods.create');
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

        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();

        $Period = Period::create($request_data);

        if ($Period) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.periods.index');
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
        $period = Period::find($id);

        return view('dashboard.periods.edit', compact('period'));
    }

    //end of edit
    //
    public function show($id)
    {
        $period = Period::find($id);

        return view('dashboard.periods.show', compact('period'));
    }//end of edit

    /*----------------------------------------------------
    || Name     : update data into database using category        |
      || Tested   : Done                                    |
     ||                                     |
         ||                                    |
             -----------------------------------------------------*/

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',

        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $period = Period::find($id);
        $result = $period->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));
        } else {
            Alert::success('Success', __('site.update_faild'));

//            session()->flash('error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.periods.index');

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
        $period = Period::find($id);
        $result = $period->delete();
        if ($period) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
