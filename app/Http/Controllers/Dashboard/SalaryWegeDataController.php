<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\SalaryWege;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class SalaryWegeDataController extends Controller
{
    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index()
    {
        return view('dashboard.salaries_wages.index');
    }//end of index

    public function salariesWagesTranslation()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $salaries = SalaryWege::get();
        } else {
            $salaries = SalaryWege::where('user_id', Auth::id())->get();
        }

//        return $salary;

        return view('dashboard.salaries_wages.salary', compact('salaries'));
    }

    /*----------------------------------------------------
    || Name     : open pages create                     |
    || Tested   : Done                                    |
    ||                                     |
    ||                                    |
    -----------------------------------------------------*/

    public function create(Request $request)
    {
        $startDate = $request->startDate;

        Session::put('startDate', $startDate);

//        return $request;
        //return Session::get('startDate');

        if (! empty($request->startDate) && ! empty($request->branches) && ! empty($request->companies) && ! empty($request->projects)) {
            $employee = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');
            $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
            $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->whereIn('id', $employeess)->whereIn('id', $employeesss)->get();
        } elseif (! empty($request->startDate) && ! empty($request->branches) && ! empty($request->categories) && ! empty($request->companies) && ! empty($request->projects)) {
            $employee = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');
            $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
            $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
            $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->whereIn('id', $employees)->whereIn('id', $employeess)->whereIn('id', $employeesss)->get();
        } elseif (! empty($request->startDate) && ! empty($request->categories) && ! empty($request->companies) && ! empty($request->projects)) {
            $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
            $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
            $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employees)->whereIn('id', $employeess)->whereIn('id', $employeesss)->get();
        } elseif (! empty($request->startDate) && ! empty($request->companies) && ! empty($request->categories)) {
            $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
            $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employees)->whereIn('id', $employeess)->get();
        } elseif (! empty($request->startDate) && ! empty($request->branches) && ! empty($request->projects)) {
            $employee = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');
            $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->whereIn('id', $employeesss)->get();
        } elseif (! empty($request->startDate) && ! empty($request->categories) && ! empty($request->projects)) {
            $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
            $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employees)->whereIn('id', $employeesss)->get();
        } elseif (! empty($request->startDate) && ! empty($request->branches) && ! empty($request->companies)) {
            $employee = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');
            $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->whereIn('id', $employeess)->get();
        } elseif (! empty($request->startDate) && ! empty($request->companies) && ! empty($request->projects)) {
            $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
            $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employeess)->whereIn('id', $employeesss)->get();
        } elseif (! empty($request->startDate) && ! empty($request->projects)) {
            $employee = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->get();
        } elseif (! empty($request->startDate) && ! empty($request->companies)) {
            $employee = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->get();
        } elseif (! empty($request->startDate) && ! empty($request->categories)) {
            $employee = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->get();
        } elseif (! empty($request->startDate) && ! empty($request->branches)) {
            $employee = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

            $users = User::where('Termination_type', '!=', 'Resignation')->whereIn('id', $employee)->get();
        } else {
            $users = User::where('Termination_type', '!=', 'Resignation')->get();
        }

        return view('dashboard.salaries_wages.tables', compact('users', 'startDate'));
    }//end of create

    /*----------------------------------------------------
    || Name     : store data into database branches          |
      || Tested   : Done                                    |
         ||                                     |
       ||                                    |
        -----------------------------------------------------*/

    public function salaryPdf($id)
    {
        $salaryweges = SalaryWege::find($id);

        $employee = User::where('id', $salaryweges->employee_id)->first();

        $data = [
            'foo' => 'bar',
        ];
        $pdf_doc = PDF::loadview('dashboard.salaries_wages.print', ['data' => $data, 'salaryweges' => $salaryweges, 'employee' => $employee]);

        return $pdf_doc->stream('salaries_wages.pdf');
    }

    public function store(Request $request)
    {
        $request_data = $request->all();

        Session::put('detailsalary', $request_data);

//        return $request;

        foreach ($request['selcectemployee'] as $value) {
            $key = array_search($value, $request_data['employee_id']);
            //return $request['aspirantdues'][$key] .$request['outofwork'][$key];

            $salary = $request['basic_salary'][$key] ?? 0;

            $merit = $request['merits'][$key] ?? 0;
            $work = $request['outofwork'][$key] ?? 0;

            $aspirantdues = $request['aspirantdues'][$key] ?? 0;

            $reconnaissance = $request['reconnaissance'][$key] ?? 0;
            $Addmoredeductions = $request['Addmoredeductions'][$key] ?? 0;
            $Socialinsurancediscount = $request['Socialinsurancediscount'][$key] ?? 0;

            $absance = $request['absance'][$key] ?? 0;
            $Residence = $request['Residence'][$key] ?? 0;

            $total = $salary + $merit + $work + $aspirantdues - $reconnaissance - $Addmoredeductions - $Socialinsurancediscount - $absance - $Residence;

//            return $total;
            User::updateOrCreate(['id' => $request['employee_id'][$key] ?? ''],

                [

                    'id' => $request['employee_id'][$key] ?? '',

                    'basic_salary' => $request['basic_salary'][$key] ?? '',

                    'total_salary' => $total,

                ]);
        }

        $users = User::whereIn('id', $request['selcectemployee'])->get();

        $startDate = Session::get('startDate');

//        if ($request_data['selcectemployee']) {
        return view('dashboard.salaries_wages.showtable', compact('users', 'startDate', 'request_data'));

//        } else {
//            Alert::toast('Error', __('site.notselecletedemployee'));
//
//            return back();
//
//        }
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

    /**
     * @return mixed
     */
    public function show($id)
    {
        return view('dashboard.salaries_wages.showsalary');
    }//end of show

    /*----------------------------------------------------
     || Name     : update data into database using banner        |
       || Tested   : Done                                    |
            ||                                     |
                ||                                    |
        -----------------------------------------------------*/

    public function update(Request $request, $id)
    {
        $salaryDetail = Session::get('detailsalary');

//        return $salaryDetail;

        $users = User::get();

        foreach ($salaryDetail['selcectemployee'] as $userId) {
            $key = array_search($userId, $salaryDetail['employee_id']);

            SalaryWege::create(

                [

                    'employee_id' => $userId,

                    'total_salary' => User::where('id', $userId)->first()->total_salary ?? 0,

                    'transfer_month' => $request['transfer_month'] ?? '',

                    'basic_salary' => User::where('id', $userId)->first()->basic_salary ?? 0,

                    'merits' => $salaryDetail['merits'][$key] ?? '',
                    'outofwork' => $salaryDetail['outofwork'][$key] ?? '',
                    'aspirantdues' => $salaryDetail['aspirantdues'][$key] ?? '',
                    'reconnaissance' => $salaryDetail['reconnaissance'][$key] ?? '',
                    'Addmoredeductions' => $salaryDetail['Addmoredeductions'][$key] ?? '',
                    'Socialinsurancediscount' => $salaryDetail['Socialinsurancediscount'][$key] ?? '',
                    'absance' => $salaryDetail['absance'][$key] ?? '',
                    'Residence' => $salaryDetail['Residence'][$key] ?? '',
                    'hiring_date' => Session::get('startDate') ?? '',

                ]);
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
