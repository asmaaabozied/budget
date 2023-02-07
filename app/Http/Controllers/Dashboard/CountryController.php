<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\CountriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(CountriesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.countries'),
            'model' => 'countries',
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
        return view('dashboard.countries.create');
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
        $request_data = $request->except('name_ar_city', 'name_en_city', '_method', '_token');
        $request_data['user_id'] = Auth::id();
        $reason = Country::create($request_data);

        if (! empty($request->name_ar_city)) {
            foreach ($request->name_ar_city as $key => $value) {
                City::create([

                    'name_ar' => $request['name_ar_city'][$key] ?? '',
                    'name_en' => $request['name_en_city'][$key] ?? '',
                    'country_id' => $reason->id,
                    'user_id' => Auth::id(),

                ]);
            }
        }
        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.countries.index');
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
        $country = Country::find($id);
        $cities = City::where('country_id', $id)->get();

        return view('dashboard.countries.edit', compact('country', 'cities'));
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
        $currency = Country::find($id);

        $request_data = $request->except('name_ar_city', 'name_en_city', '_method', '_token', 'city_id');
        $result = $currency->update($request_data);

        if (! empty($request->name_ar_city)) {
            foreach ($request->name_ar_city as $key => $value) {
                City::updateOrCreate(['id' => $request['city_id'][$key] ?? ''], [

                    'name_ar' => $request['name_ar_city'][$key] ?? '',
                    'name_en' => $request['name_en_city'][$key] ?? '',
                    'country_id' => $id,
                    'user_id' => Auth::id(),

                ]);
            }
        }

        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

//                flash(__('site.updated_successfully'))->success();
            return redirect()->route('dashboard.countries.index');
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.countries.index');
    }

    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
//        return $id;
        City::where('country_id', $id)->delete();
        $reason = Country::find($id);
//        if($id=1){
//            return back();
//        }
//        else{
        $result = $reason->delete();

//        }

        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
