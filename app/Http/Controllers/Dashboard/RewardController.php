<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\RewardDataTable;
use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Reward;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(RewardDataTable $dataTable)
    {

//        return Loan::first()->user->full_name;

        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.rewards'),
            'model' => 'rewards',
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
        return view('dashboard.rewards.create');
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
        $data = Reward::create($request_data);

        if ($data) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.rewards.index');
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
        $loan = Reward::find($id);

        return view('dashboard.rewards.edit', compact('loan'));
    }//end of edit

    public function show($id)
    {
        $loan = Reward::find($id);

        return view('dashboard.rewards.show', compact('loan'));
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
        $data = Reward::find($id);

        $request_data = $request->all();

        $result = $data->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.rewards.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.rewards.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $loan = Reward::find($id);
        $result = $loan->delete();
        if ($loan) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
