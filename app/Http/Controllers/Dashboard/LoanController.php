<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\LoansDataTable;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(LoansDataTable $dataTable)
    {

//        return Loan::first()->user->full_name;

        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.loans'),
            'model' => 'loans',
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
        return view('dashboard.loans.create');
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
        $data = Loan::create($request_data);

        if ($data) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.loans.index');
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
        $loan = Loan::find($id);

        return view('dashboard.loans.edit', compact('loan'));
    }//end of edit

    public function show($id)
    {
        $loan = Loan::find($id);

        return view('dashboard.loans.show', compact('loan'));
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
        $data = Loan::find($id);

        $request_data = $request->all();

        $result = $data->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.loans.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.loans.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $loan = Loan::find($id);
        $result = $loan->delete();
        if ($loan) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
