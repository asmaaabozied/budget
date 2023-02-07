<?php

namespace App\Http\Controllers\Dashboard;

use Alert;
use App\DataTables\EmployeeDataTable;
use App\DataTables\ReportEmployeeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Employee;
use App\Models\Follower;
use App\Models\Loan;
use App\Models\Page;
use App\Models\Rating;
use App\Models\SalaryWege;
use App\Models\Vehicle;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Jenssegers\Agent\Agent;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Response;
use Stevebauman\Location\Facades\Location;

class EmployeController extends Controller
{
    use RegistersUsers {
        // We are doing this so the predefined register method does not clash with this one we just defined.
        register as registration;
    }

    /*----------------------------------------------------
    || Name     : show all Banners                     |
    || Tested   : Done                                    |
    || using  : datatables                                      |
    ||                                    |
    -----------------------------------------------------*/
    public function index(EmployeeDataTable $dataTable)
    {
        $agent = new Agent();

        $devicename = $agent->device() . '_' . $agent->deviceType() . '_' . $agent->platform() . '_' . $agent->browser();

        $location = Location::get();

//        return $location;

        Device::updateOrCreate([

            'ip' => $location->ip,
        ], [

            'name' => $devicename,
            'county' => $location->countryName,
            'countryCode' => $location->countryCode,
            'regionName' => $location->regionName,
            'areaCode' => $location->areaCode,
            'city' => $location->cityName,
            'region' => $location->regionName,
            'timezone' => $location->timezone,
            'driver' => $location->driver,
            'ip' => $location->ip,

        ]);

        return $dataTable->render('dashboard.employee.datatable', [
            'title' => trans('site.employee'),
            'model' => 'employee',
            'count' => $dataTable->count(),
        ]);
    }//end of index

    public function deleteDevice($id)
    {
        $device = Device::find($id);

        $device->delete();

        Alert::toast('Deleted', __('site.deleted_successfully'));

        return back();
    }

    public function chanagepassword(Request $request)
    {
//        return $request;

        $request->validate([

            'password' => 'required|min:4',
            'newpassword' => 'required|min:4',
            //            'confirmpassword' => 'required_with:newpassword|same:newpassword|min:6'

        ],

            [
                'newpassword.regex' => __('site.password_regex'),
            ]
        );

        $employe = User::find($request->id);

        if (Hash::check($request['password'], $employe->password)) {

//            return "dfdf";

            $employe->fill([
                'password' => Hash::make($request->newpassword),
            ])->save();

            Alert::success('Success', __('site.updated_successfully'));

            return back();
//            return redirect()->route('dashboard.employee.index');
        } else {
            Alert::success('Error', __('site.update_faild'));

            return back();
        }

        return back();
    }

    //
    public function ReportEmployee(ReportEmployeeDataTable $dataTable)
    {
        return $dataTable->render('dashboard.reports.datatable', [
            'title' => trans('site.employee'),
            'model' => 'employee',
            'count' => $dataTable->count(),
        ]);
    }//end of index

    public function Receiptemployee()
    {

//        $timestamp = strtotime('2022');
//        $last_second = date('m-t-Y 12:59:59', $timestamp); // A leap year!
        $todays = Carbon::now()->format('d');
        $lastmonth = 30;

        $remainday = $lastmonth - $todays;

//        return $remainday;

//        $result = Carbon::now()->diffInDays($last_second, false);

//        return $date = Carbon::now()->format('d');;

        $date = Carbon::now()->format('d-m-Y');

        $today = Carbon::now();
        $dayName = $today->format('l');

        // return Carbon::now()->daysInMonth;
        $subdate = Carbon::now()->subDays(30)->diffForHumans();

        // return $subdate;
        $hour = Carbon::now()->toDayDateTimeString();

        // $hour= $date->hour.'::'.$date->minute;
        $note = Page::first()->description ?? '';
        $rate = Rating::where('employe_id', Auth::id())->first()->rate ?? '';

        return view('dashboard.employee', compact('remainday', 'date', 'dayName', 'note', 'rate', 'hour'));
    }

    /*----------------------------------------------------
    || Name     : open pages create                     |
    || Tested   : Done                                    |
    ||                                     |
    ||                                    |
    -----------------------------------------------------*/

    public function download($file)
    {

//         $file_path = base_path('images/employee/' . $file);

//         // return $file_path;

        // //        $file_path =asset('images/employee/'.$file);

//         return response()->download('https://www.budget.help/'.'images/employee/' . $file);

        $file = base_path() . '/images/employee/' . $file;

        $headers = [
            'Content-Type: application/pdf',
        ];

        return Response::download($file, 'image.pdf', $headers);
    }

    public function create()
    {
        return view('dashboard.employee.create');
    }//end of create

    public function store(Request $request)
    {
        $request->validate([
        ]);

//        DB::beginTransaction();
//        try {
        $request_data = $request->except('image', 'projects', 'salaries', 'name_file', 'photo', 'end_date', 'companies', 'categories', 'branches',
            'hoppy_end_date3', 'hoppy_start_date2', 'tax_numbers', 'date4', 'status_insure_date', 'date3',
            'tax_type_date', 'tax_type', 'passport_number', 'status_insure', 'name_insure', 'number2',
            'Trial_end_date', 'yearly_vacation', 'style', 'brand', 'color', 'start_date', 'ID_expiration_date', 'Insurance_name', 'Insuranc_start_date', 'ID_expiration_dates',
            'number', 'full_name', 'hoppys', 'Insuranc_end_date', 'type2', 'housing_allowances', 'Transportation_allowances'
        );

        $request_data['password'] = bcrypt($request->password);
        $request_data['types'] = 'Employee';
        $request_data['user_id'] = Auth::id();
        $request_data['types'] = 'Employee';
        $request_data['basic_salary'] = $request['salaries']['basic_salary'] ?? 0;
        $reason = User::create($request_data);

        SalaryWege::create($request->salaries + ['employee_id' => $reason->id]);

        if (!empty($request->companies)) {
            $reason->companies()->attach($request->companies);
        }

        if (!empty($request->projects)) {
            $reason->projects()->attach($request->projects);
        }

        if (!empty($request->categories)) {
            $reason->categories()->attach($request->categories);
        }
        if (!empty($request->branches)) {
            $reason->branches()->attach($request->branches);
        }

        Employee::create([
            'hoppy_end_date3' => $request->hoppy_end_date3 ?? '', 'tax_numbers' => $request->tax_numbers ?? '',
            'hoppy_start_date2' => $request->hoppy_start_date2 ?? '',
            'date4' => $request->date4, 'user_id' => $reason->id,
            'status_insure_date' => $request->status_insure_date ?? '',
            'date3' => $request->date3, 'tax_type_date' => $request->tax_type_date, 'tax_type' => $request->tax_type ?? '',
            'passport_number' => $request->passport_number ?? '',
            'housing_allowances' => $request->housing_allowances ?? '',
            'Transportation_allowances' => $request->Transportation_allowances ?? '',
            'status_insure' => $request->status_insure ?? '', 'name_insure' => $request->name_insure ?? '', 'number2' => $request->number2 ?? '',
        ]);

        if (!empty($request->Insurance_name)) {
            foreach ($request->Insurance_name as $key => $value) {
                Vehicle::create([
                    'Insurance_name' => $request['Insurance_name'][$key] ?? '',
                    'Insuranc_start_date' => $request['Insuranc_start_date'][$key] ?? '',
                    'ID_expiration_dates' => $request['ID_expiration_dates'][$key] ?? '',
                    'Trial_end_date' => $request['Trial_end_date'][$key] ?? '',
                    'yearly_vacation' => $request['yearly_vacation'][$key] ?? '',
                    'brand' => $request['brand'][$key] ?? '',
                    'color' => $request['color'][$key] ?? '',
                    'start_date' => $request['start_date'][$key] ?? '',
                    'ID_expiration_date' => $request['ID_expiration_date'][$key] ?? '',
                    'style' => $request['style'][$key] ?? '',
                    'user_id' => $reason->id,
                ]);
            }
        }

        if (!empty($request->full_name)) {
            foreach ($request->full_name as $key => $value) {
                Follower::create([
                    'full_name' => $request['full_name'][$key] ?? '',
                    'number' => $request['number'][$key] ?? '',
                    'hoppy' => $request['hoppys'][$key] ?? '',
                    'Insuranc_end_date' => $request['Insuranc_end_date'][$key] ?? '',
                    'type1' => $request['type2'][$key] ?? '',
                    'user_id' => $reason->id,

                ]);
            }
        }

        $reason->syncRoles(['2']);

        if ($request->hasFile('image')) {
            foreach ($request->image as $key => $image) {
                $destinationPath = 'images/employee/';
                $extension = $image->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $image->move($destinationPath, $name); // uploading file to given
                \App\Models\Image::create([
                    'image' => $name,
                    'imageable_type' => \App\User::class,
                    'imageable_id' => $reason->id,
                    'name' => $request['name_file'][$key],
                    'end_date' => $request['end_date'][$key],
                ]);
            }
        }

        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo');
            $destinationPath = 'images/employee/';
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath, $filename);
            $reason->image = $filename;
            $reason->save();
        }
//
//        if ($request->hasFile('quality_image')) {
//            $thumbnail = $request->file('quality_image');
//            $destinationPath = 'images/employee/';
//            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
//            $thumbnail->move($destinationPath, $filename);
//            $reason->quality_image = $filename;
//            $reason->save();
//
//        }
//
//        if ($request->hasFile('image_fish')) {
//            $thumbnail = $request->file('image_fish');
//            $destinationPath = 'images/employee/';
//            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
//            $thumbnail->move($destinationPath, $filename);
//            $reason->image_fish = $filename;
//            $reason->save();
//
//        }
//        if ($request->hasFile('Contract_image')) {
//            $thumbnail = $request->file('Contract_image');
//            $destinationPath = 'images/employee/';
//            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
//            $thumbnail->move($destinationPath, $filename);
//            $reason->Contract_image = $filename;
//            $reason->save();
//
//        }
//        if ($request->hasFile('ID_file')) {
//            $thumbnail = $request->file('ID_file');
//            $destinationPath = 'images/employee/';
//            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
//            $thumbnail->move($destinationPath, $filename);
//            $reason->ID_file = $filename;
//            $reason->save();
//
//        }

        if ($reason) {
            Alert::success('Success', __('site.added_successfully'));

            return redirect()->route('dashboard.employee.index');
        }
    }//end of store

    public function edit($id)
    {
        if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) {
            $employee = User::find($id);
            $salaryweges = SalaryWege::where('employee_id', $id)->first();
            $projects = DB::table('project_employee')->where('employee_id', $id)->pluck('project_id')->toArray();

            $categories = DB::table('category_employee')->where('employee_id', $id)->pluck('category_id')->toArray();
            $branches = DB::table('branch_employee')->where('employee_id', $id)->pluck('branch_id')->toArray();
            $companies = DB::table('company_employee')->where('employee_id', $id)->pluck('company_id')->toArray();

            // return $employee;
            $followers = Follower::where('user_id', $id)->get();
            $vehicles = Vehicle::where('user_id', $id)->get();
            $employees = Employee::where('user_id', $id)->first();

            return view('dashboard.employee.edit', compact('employee', 'projects', 'salaryweges', 'companies', 'branches', 'categories', 'followers', 'vehicles', 'employees'));
        } elseif ($id == Auth::id()) {
            $employee = User::find(Auth::id());
            $salaryweges = SalaryWege::where('employee_id', $id)->first();

            $categories = DB::table('category_employee')->where('employee_id', $id)->pluck('category_id')->toArray();
            $branches = DB::table('branch_employee')->where('employee_id', $id)->pluck('branch_id')->toArray();
            $projects = DB::table('project_employee')->where('employee_id', $id)->pluck('project_id')->toArray();
            $companies = DB::table('company_employee')->where('employee_id', $id)->pluck('company_id')->toArray();

            $followers = Follower::where('user_id', $id)->get();
            $vehicles = Vehicle::where('user_id', $id)->get();
            $employees = Employee::where('user_id', $id)->first();

            return view('dashboard.employee.edit', compact('employee', 'projects', 'salaryweges', 'companies', 'branches', 'categories', 'followers', 'vehicles', 'employees'));
        } else {
            Alert::success('Success', __('site.notaccesspermisssions'));

            return redirect(url('/ar/dashboard'));
        }
    }

    public function printpdf($id)
    {
        $employee = User::find($id);
        $followers = Follower::where('user_id', $id)->get();
        $vehicles = Vehicle::where('user_id', $id)->get();
        $loan = Loan::where('employee_id', $id)->first();

        $categories = DB::table('category_employee')->where('employee_id', $id)->pluck('category_id')->toArray();
        $branches = DB::table('branch_employee')->where('employee_id', $id)->pluck('branch_id')->toArray();
        $companies = DB::table('company_employee')->where('employee_id', $id)->pluck('company_id')->toArray();

        $data = [
            'foo' => 'bar',
        ];
        $pdf_doc = PDF::loadview('dashboard.employee.print', ['data' => $data, 'employee' => $employee, 'companies' => $companies, 'branches' => $branches, 'categories' => $categories, 'followers' => $followers, 'vehicles' => $vehicles, 'loan' => $loan]);

        return $pdf_doc->stream('employee.pdf');
    }

    public function show($id)
    {
        if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) {
            $employee = User::find($id);
            $followers = Follower::where('user_id', $id)->get();
            $vehicles = Vehicle::where('user_id', $id)->get();
            $loan = Loan::where('employee_id', $id)->first();
            $salaryweges = SalaryWege::where('employee_id', $id)->first();
            $salary1 = $salaryweges->variablefood_allowance ?? 0;
            $salary2 = $employee->basic_salary ?? 0;

            $total = $salary1 + $salary2 ;


            $projects = DB::table('project_employee')->where('employee_id', $id)->pluck('project_id')->toArray();

            $categories = DB::table('category_employee')->where('employee_id', $id)->pluck('category_id')->toArray();
            $branches = DB::table('branch_employee')->where('employee_id', $id)->pluck('branch_id')->toArray();
            $companies = DB::table('company_employee')->where('employee_id', $id)->pluck('company_id')->toArray();

            return view('dashboard.employee.show', compact('employee', 'total', 'projects', 'salaryweges', 'companies', 'branches', 'categories', 'followers', 'vehicles', 'loan'));
        } elseif ($id == Auth::id()) {
            $employee = User::find(Auth::id());
            $followers = Follower::where('user_id', $id)->get();
            $vehicles = Vehicle::where('user_id', $id)->get();
            $loan = Loan::where('employee_id', $id)->first();
            $salaryweges = SalaryWege::where('employee_id', $id)->first();
            $projects = DB::table('project_employee')->where('employee_id', $id)->pluck('project_id')->toArray();
            $categories = DB::table('category_employee')->where('employee_id', $id)->pluck('category_id')->toArray();
            $branches = DB::table('branch_employee')->where('employee_id', $id)->pluck('branch_id')->toArray();
            $companies = DB::table('company_employee')->where('employee_id', $id)->pluck('company_id')->toArray();
            $salary1 = $salaryweges->variablefood_allowance ?? 0;
            $salary2 = $employee->basic_salary ?? 0;

            $total = $salary1 + $salary2 ;
            return view('dashboard.employee.show', compact('employee', 'total', 'projects', 'salaryweges', 'companies', 'branches', 'categories', 'followers', 'vehicles', 'loan'));
        } else {
            Alert::success('Success', __('site.notaccesspermisssions'));
//            session()->flash('success', __('site.notaccesspermisssions'));
            return redirect(url('/ar/dashboard'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        ]);

        $currency = User::find($id);
        $request_data = $request->except('image', 'projects', 'name_file', 'salaries', 'photo', 'companies', 'categories', 'branches', 'end_date', 'password', 'newpassword', 'confirmpassword',
            'hoppy_end_date3', 'hoppy_start_date2', 'tax_numbers', 'date4', 'status_insure_date', 'date3',
            'tax_type_date', 'tax_type', 'passport_number', 'status_insure', 'name_insure', 'number2',
            'Trial_end_date', 'yearly_vacation', 'style', 'brand', 'color', 'start_date', 'ID_expiration_date', 'Insurance_name', 'Insuranc_start_date', 'ID_expiration_dates',
            'number', 'full_name', 'hoppys', 'Insuranc_end_date', 'type2', 'housing_allowances', 'Transportation_allowances', 'follewer_id', 'vehicle_id'
        );

        if (!empty($request->password)) {
            $request_data['password'] = bcrypt($request->password);
        } else {
            $request_data = $request->except('image', 'projects', 'salaries', 'companies', 'categories', 'branches', 'name_file', 'photo', 'end_date', 'password', 'newpassword', 'confirmpassword',
                'hoppy_end_date3', 'hoppy_start_date2', 'tax_numbers', 'date4', 'status_insure_date', 'date3',
                'tax_type_date', 'tax_type', 'passport_number', 'status_insure', 'name_insure', 'number2',
                'Trial_end_date', 'yearly_vacation', 'style', 'brand', 'color', 'start_date', 'ID_expiration_date', 'Insurance_name', 'Insuranc_start_date', 'ID_expiration_dates',
                'number', 'full_name', 'hoppys', 'Insuranc_end_date', 'type2', 'housing_allowances', 'Transportation_allowances', 'follewer_id', 'vehicle_id'
            );
        }

        $request_data['basic_salary'] = $request['salaries']['basic_salary'] ?? 0;
        $result = $currency->update($request_data);

        if (!empty($request->salaries)) {
            $salary = SalaryWege::where('employee_id', $id)->first();

            if ($salary) {
                $salary->update($request->salaries);
            } else {
                SalaryWege::create($request->salaries + ['employee_id' => $id]);
            }
        }

        if (!empty($request->companies)) {
            DB::table('company_employee')->where('employee_id', $id)->delete();

            foreach ($request->companies as $value) {
                DB::table('company_employee')->insert([
                    'employee_id' => $id,
                    'company_id' => $value,
                ]);
            }
        }
        if (!empty($request->projects)) {
            DB::table('project_employee')->where('employee_id', $id)->delete();
            foreach ($request->projects as $value) {
                DB::table('project_employee')->insert([
                    'employee_id' => $id,
                    'project_id' => $value,
                ]);
            }
        }

        if (!empty($request->categories)) {
            DB::table('category_employee')->where('employee_id', $id)->delete();
            foreach ($request->categories as $value) {
                DB::table('category_employee')->insert([
                    'employee_id' => $id,
                    'category_id' => $value,
                ]);
            }
        }
        if (!empty($request->branches)) {
            DB::table('branch_employee')->where('employee_id', $id)->delete();
            foreach ($request->branches as $value) {
                DB::table('branch_employee')->insert([
                    'employee_id' => $id,
                    'branch_id' => $value,
                ]);
            }
        }

        Employee::updateOrCreate(['user_id' => $id], [
            'hoppy_end_date3' => $request->hoppy_end_date3 ?? '', 'tax_numbers' => $request->tax_numbers ?? '',
            'hoppy_start_date2' => $request->hoppy_start_date2 ?? '',
            'date4' => $request->date4 ?? '', 'user_id' => $id,
            'status_insure_date' => $request->status_insure_date ?? '',
            'date3' => $request->date3 ?? '', 'tax_type_date' => $request->tax_type_date ?? '', 'tax_type' => $request->tax_type ?? '',
            'passport_number' => $request->passport_number ?? '',
            'housing_allowances' => $request->housing_allowances ?? '',
            'Transportation_allowances' => $request->Transportation_allowances ?? '',
            'status_insure' => $request->status_insure ?? '', 'name_insure' => $request->name_insure ?? '', 'number2' => $request->number2 ?? '',
        ]);

        if (!empty($request->Insurance_name)) {
            foreach ($request->Insurance_name as $key => $value) {
                Vehicle::updateOrCreate(
                    ['id' => $request['vehicle_id'][$key] ?? ''], [
                    'Insurance_name' => $request['Insurance_name'][$key] ?? '',
                    'Insuranc_start_date' => $request['Insuranc_start_date'][$key] ?? '',
                    'ID_expiration_dates' => $request['ID_expiration_dates'][$key] ?? '',
                    'Trial_end_date' => $request['Trial_end_date'][$key] ?? '',
                    'yearly_vacation' => $request['yearly_vacation'][$key] ?? '',
                    'brand' => $request['brand'][$key] ?? '',
                    'color' => $request['color'][$key] ?? '',
                    'start_date' => $request['start_date'][$key] ?? '',
                    'ID_expiration_date' => $request['ID_expiration_date'][$key] ?? '',
                    'style' => $request['style'][$key] ?? '',
                    'user_id' => $id,
                ]);
            }
        }
        if (!empty($request->full_name)) {
            foreach ($request->full_name as $key => $value) {
                Follower::updateOrCreate(
                    ['id' => $request['follewer_id'][$key] ?? ''], [
                    'full_name' => $request['full_name'][$key] ?? '',
                    'number' => $request['number'][$key] ?? '',
                    'hoppy' => $request['hoppys'][$key] ?? '',
                    'Insuranc_end_date' => $request['Insuranc_end_date'][$key] ?? '',
                    'type1' => $request['type2'][$key] ?? '',
                    'user_id' => $id,
                ]);
            }
        }

        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo');
            $destinationPath = 'images/employee/';
            $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($destinationPath, $filename);
            $currency->image = $filename;
            $currency->save();
        }
        if ($request->hasFile('image')) {
            foreach ($request->image as $key => $image) {
                $destinationPath = 'images/employee/';
                $extension = $image->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $image->move($destinationPath, $name); // uploading file to given
                \App\Models\Image::create([
                    'image' => $name,
                    'imageable_type' => \App\User::class,
                    'imageable_id' => $currency->id,
                    'name' => $request['name_file'][$key],
                    'end_date' => $request['end_date'][$key],
                ]);
            }
        }

//        }
        if ($result) {
            Alert::success('Success', __('site.updated_successfully'));

            return back();
        } else {
            Alert::success('Error', __('site.update_faild'));
        }

        return back();
    }

    public function destroy($id)
    {
        $reason = User::find($id);
        $result = $reason->delete();
        if ($reason) {
            Alert::toast('Deleted', __('site.deleted_successfully'));
        } else {
            Alert::error('Error', __('site.delete_faild'));
        }

        return back();
    }

    public function deleteimages($id)
    {
        if (isset($id)) {
            $data = \App\Models\Image::where('id', $id)->first();
            if ($data->image) {
                if (File::exists('images/employee/' . $data->image)) {
                    unlink('images/employee/' . $data->image);
                }
            }
            \App\Models\Image::where('id', $id)->delete();
            Alert::toast('Deleted', __('site.deleted_successfully'));
        }

        return back();
    }
}
