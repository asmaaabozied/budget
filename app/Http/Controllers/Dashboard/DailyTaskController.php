<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\DailytaskDataTable;
use App\Http\Controllers\Controller;
use App\Models\Dailytask;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyTaskController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(DailytaskDataTable $dataTable)
    {
        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.dailytasks'),
            'model' => 'dailytasks',
            'count' => $dataTable->count(),
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
        return view('dashboard.dailytasks.create');
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
            'date' => 'required',

        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $reason = Dailytask::create($request_data);

        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.dailytasks.index');
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
        $dailytask = Dailytask::find($id);

        return view('dashboard.dailytasks.edit', compact('dailytask'));
    }//end of edit

    public function show($id)
    {
        $dailytask = Dailytask::find($id);

        return view('dashboard.dailytasks.show', compact('dailytask'));
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
            'date' => 'required',

        ]);
//        DB::beginTransaction();
//        try {
        $currency = Dailytask::find($id);

        $request_data = $request->all();

        $result = $currency->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.dailytasks.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.dailytasks.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $reason = Dailytask::find($id);
        $result = $reason->delete();
        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error Title', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
