<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\DiscountsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(DiscountsDataTable $dataTable)
    {

//        return Loan::first()->user->full_name;

        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.discounts'),
            'model' => 'discounts',
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
        return view('dashboard.discounts.create');
    }//end of create

    /*----------------------------------------------------
    || Name     : store data into database branches          |
      || Tested   : Done                                    |
         ||                                     |
       ||                                    |
        -----------------------------------------------------*/

    public function store(Request $request)
    {

//        $request->validate([
//            'full_name' => 'required|string',
//
//
//        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $data = Discount::create($request_data);

        if ($data) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.discounts.index');
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
        $loan = Discount::find($id);

        return view('dashboard.discounts.edit', compact('loan'));
    }//end of edit

    public function show($id)
    {
        $loan = Discount::find($id);

        return view('dashboard.discounts.show', compact('loan'));
    }//end of show

    /*----------------------------------------------------
     || Name     : update data into database using banner        |
       || Tested   : Done                                    |
            ||                                     |
                ||                                    |
        -----------------------------------------------------*/

    public function update(Request $request, $id)
    {

//        DB::beginTransaction();
//        try {
        $data = Discount::find($id);

        $request_data = $request->all();

        $result = $data->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.discounts.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.discounts.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $loan = Discount::find($id);
        $result = $loan->delete();
        if ($loan) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
