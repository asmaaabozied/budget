<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ReportUsersDataTable;
use App\DataTables\UserReportDatatables;
use App\Http\Controllers\Controller;
use App\Models\UserReport;
use App\User;
use Carbon\carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Response;

class UserReportController extends Controller
{
    public function index(UserReportDatatables $userReportDatatables)
    {
        return $userReportDatatables->render('dashboard.datatable', [
            'title' => trans('site.userReports'),
            'model' => 'userReports',
            'count' => $userReportDatatables->count(),
        ]);
    }//end of index

    public function getReportUsers(ReportUsersDataTable $reportUsersDataTable)
    {
        return $reportUsersDataTable->render('dashboard.reportdatatable', [
            'title' => trans('site.userReports'),
            'model' => 'userReports',
            'route' => 'usersReports',
            'count' => $reportUsersDataTable->count(),   'countmonth' => $reportUsersDataTable->countmonth(),

        ]);
    }

    public function create()
    {
    }//end of create

    public function store(Request $request)
    {
    }//end of store

    public function edit($id)
    {
        $userReport = UserReport::find($id);
        //dd($userReport->user_id);
        $UserReport['user_name'] = User::find($userReport->user_id);

        return view('dashboard.userReports.edit', compact('userReport'));
    }//end of edit

    public function update(Request $request, UserReport $userReport)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);
//        DB::beginTransaction();
//        try {
        $request_data = $request->all();
        //dd($request_data);
        $request_data['emp_id'] = Auth::user()->id;
        $request_data['status'] = 'responded';
        $request_data['answered_at'] = Carbon::now();
        $result = $userReport->update($request_data);

        if ($result) {
            flash(__('site.updated_successfully'))->success();

            return redirect()->route('dashboard.userReports.index');

//            session()->flash('success', __('site.updated_successfully'));
        } else {
            flash(__('site.update_faild'))->success();

//            session()->flash('error', __('site.update_faild'));
        }

        return redirect()->route('dashboard.userReports.index');

//            DB::commit();
//        } catch (\Exception $e) {
//            ///Roll the db back if something happened
//            DB::rollback();
//            return response([
//                'status' => 'error',
//                // 'error' => $e->getMessage(),
//                'message' => trans('site.Try_again_something_went_wrong.'),
//            ], 500);
//        }
//        return back();
    }

    public function destroy($id)
    {
        $userReport = UserReport::find($id);
        if (! $userReport) {
            flash(__('site.delete_faild'))->success();

//            session()->flash('error', __('site.delete_faild'));
            return back();
        }
        $result = $userReport->delete();
        if ($result) {
            flash(__('site.deleted_successfully'))->success();

//            session()->flash('success', __('site.deleted_successfully'));
        } else {
            flash(__('site.delete_faild'))->success();

//            session()->flash('error', __('site.delete_faild'));
        }

        return back();
    }
}//end of controller
