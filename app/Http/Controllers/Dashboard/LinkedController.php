<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\LinkedsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Linked;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkedController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(LinkedsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.linkeds'),
            'model' => 'linkeds',
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
        return view('dashboard.linkeds.create');
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
            'name' => 'required',

        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $reason = Linked::create($request_data);

        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.linkeds.index');
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
        $linked = Linked::find($id);

        return view('dashboard.linkeds.edit', compact('linked'));
    }//end of edit

    public function show($id)
    {
        $linked = Linked::find($id);

        return view('dashboard.linkeds.show', compact('linked'));
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
            'name' => 'required',

        ]);
//        DB::beginTransaction();
//        try {
        $currency = Linked::find($id);

        $request_data = $request->all();

        $result = $currency->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.linkeds.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.linkeds.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $reason = Linked::find($id);
        $result = $reason->delete();
        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
