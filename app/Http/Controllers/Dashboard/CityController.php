<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\CitiesDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(CitiesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.cities'),
            'model' => 'cities',
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
        return view('dashboard.cities.create');
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
            'name_en' => 'required|string',
            'name_ar' => 'required|string',

        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
        $reason = City::create($request_data);

        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.cities.index');
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
        $city = City::find($id);

        return view('dashboard.cities.edit', compact('city'));
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
            'name_en' => 'required|string',
            'name_ar' => 'required|string',

        ]);
//        DB::beginTransaction();
//        try {
        $currency = City::find($id);

        $request_data = $request->all();

        $result = $currency->update($request_data);

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.cities.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.cities.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $reason = City::find($id);
        $result = $reason->delete();
        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
