<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\SalariesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Salary;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(SalariesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.salaries_wages.reportsalary', [
            'title' => trans('site.salaries'),
            'model' => 'salaries',
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

    public function create()
    {
        return view('dashboard.salaries.create');
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
        ////            'date' => 'required',
//
//
//        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $salary = Salary::create($request_data);

        if ($salary) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.salaries.index');
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
        $salary = Salary::find($id);

        return view('dashboard.salaries.edit', compact('salary'));
    }//end of edit

    public function show($id)
    {
        $salary = Salary::find($id);

        return view('dashboard.salaries.show', compact('salary'));
    }//end of edit

    /*----------------------------------------------------
     || Name     : update data into database using banner        |
       || Tested   : Done                                    |
            ||                                     |
                ||                                    |
        -----------------------------------------------------*/

    public function update(Request $request, $id)
    {
//        $request->validate([
//            'date' => 'required',
//
//
//        ]);
//        DB::beginTransaction();
//        try {
        $salary = Salary::find($id);

        $request_data = $request->all();

        $result = $salary->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.salaries.index');
        } else {
            session()->flash('error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.salaries.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $reason = Salary::find($id);
        $result = $reason->delete();
        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::toast('NoDeleted', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
