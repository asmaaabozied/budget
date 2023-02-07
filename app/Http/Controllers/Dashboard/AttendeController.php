<?php

namespace App\Http\Controllers\Dashboard;


use Alert;


use App\DataTables\AttendeesDataTable;
use App\Models\Attendee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Lang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Response;
use DB;

class AttendeController extends Controller
{


    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(AttendeesDataTable $dataTable)
    {


        return $dataTable->render('dashboard.datatable', [
            'title' => trans('site.attendees'),
            'model' => 'attendees',
            'count' => $dataTable->count()
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


        $dt = Carbon::now();

        $date= $dt->format('Y-m-d') ;
        $time = $dt->toTimeString();


        return view('dashboard.attendees.create', compact('time','date'));


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
            'period_id' => 'required',
//            'employe_id' => 'required',
            'type' => 'required',
//            'hour' => 'required',


        ]);

        $dt = Carbon::now();
        $time = $dt->toTimeString();
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        $request_data['user_id'] = Auth::id();
//        $request_data['hour'] = $time;
        $reason = Attendee::create($request_data);


        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));

//            flash(__('site.added_successfully'))->success();
            return redirect()->route('dashboard.attendees.index');


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


        $leave = Attendee::find($id);
        return view('dashboard.attendees.edit', compact('leave'));

    }//end of edit

    public function show($id)
    {


        $leave = Attendee::find($id);
        return view('dashboard.attendees.show', compact('leave'));

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
//            'period_name' => 'required',
            'hour' => 'required',


        ]);
//        DB::beginTransaction();
//        try {
        $currency = Attendee::find($id);

        $request_data = $request->all();

        $result = $currency->update($request_data);


        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return redirect()->route('dashboard.attendees.index');

        } else {

            session()->flash('error', __('site.update_faild'));
        }
        return redirect()->route('dashboard.attendees.index');

    }


    /*----------------------------------------------------
      || Name     : delete data into database using banner        |
     || Tested   : Done                                    |
      ||                                     |
      ||                                    |
         -----------------------------------------------------*/

    public function destroy($id)
    {
        $reason = Attendee::find($id);
        $result = $reason->delete();
        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));


        } else {
            Alert::error('Error', __('site.delete_faild'));


        }
        return back();
    }


}//end of controller
