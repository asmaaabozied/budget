<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\SalaryWegesDataTable;
use App\Http\Controllers\Controller;
use App\Models\SalaryWege;
use DB;
use Illuminate\Http\Request;

class SalaryWegeController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(SalaryWegesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.salaries_wages.datatable', [
            'title' => trans('site.salaries_wages'),
            'model' => 'salaries_wages',
            'count' => $dataTable->count(),
            'countEmployee' => $dataTable->countEmployee(),
            'TotalSalary' => $dataTable->TotalSalary(),
        ]);
    }//end of index

    /*----------------------------------------------------
    || Name     : open pages create                     |
    || Tested   : Done                                    |
    ||                                     |
    ||                                    |
    -----------------------------------------------------*/

    public function create(SalaryWegesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.salaries_wages.create', [
            'title' => trans('site.salaries_wages'),
            'model' => 'salaries_wages',
            'count' => $dataTable->count(),
        ]);
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

        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $reason = SalaryWege::create($request_data);

        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.salaries_wages.index');
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
        $salaryweges = SalaryWege::find($id);

        return view('dashboard.salaries_wages.edit', compact('salaryweges'));
    }//end of edit

    public function show($id)
    {
        $salaryweges = SalaryWege::find($id);

        return view('dashboard.salaries_wages.show', compact('salaryweges'));
    }//end of show

    /*----------------------------------------------------
     || Name     : update data into database using banner        |
       || Tested   : Done                                    |
            ||                                     |
                ||                                    |
        -----------------------------------------------------*/

    public function update(Request $request, $id)
    {
        $request->validate([

        ]);
//        DB::beginTransaction();
//        try {
        $currency = SalaryWege::find($id);

        $request_data = $request->all();

        $result = $currency->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.salaries_wages.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.salaries_wages.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $salarywage = SalaryWege::find($id);
        $result = $salarywage->delete();
        if ($salarywage) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
