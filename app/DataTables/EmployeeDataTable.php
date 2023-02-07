<?php

namespace App\DataTables;

use App\Helpers\DTHelper;
use App\Models\Employee;
use App\Models\SalaryWege;
use App\User;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{
    private $crudName = 'employee';

    private function getRoutes()
    {
        return [
            'update' => "dashboard.$this->crudName.edit",
            'delete' => "dashboard.$this->crudName.destroy",
            'show' => "dashboard.$this->crudName.show",
        ];
    }

    private function getPermissions()
    {
        return [
            'update' => 'update_'.$this->crudName,
            'delete' => 'delete_'.$this->crudName,
            'create' => 'create_'.$this->crudName,
        ];
    }

    /**
     * Build DataTable class.
     *
     * @param  mixed  $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query, Request $request)
    {
        $search = $this->request()->has('search') ? implode(',', $request->search) : '';

        return datatables()
            ->eloquent($query)
            ->filter(function (Builder $query) use ($search) { // custom search
                $query->when($search, function ($query, $search) {
                    $query->Where('users.name', 'LIKE', "%{$search}%")
                        ->orWhere('users.father_name', 'LIKE', "%{$search}%")
                        ->orWhere('users.family_name', 'LIKE', "%{$search}%")
                        ->orWhereRaw("CONCAT(users.name,' ', users.father_name) LIKE '%{$search}%' ")
                        ->orWhereRaw("CONCAT(users.name,' ', users.father_name,' ', users.family_name) LIKE '%{$search}%' ");
                });
            }, true)
            ->editColumn('created_at', function ($model) {
                return (! empty($model->created_at)) ? $model->created_at->diffForHumans() : '';
            })
            ->editColumn('name', function ($model) {
                return $model->name.' '.$model->father_name.' '.$model->family_name.'';
            })

//                 ->editColumn('type', function ($model) {
//
//                return  SalaryWege::where('employee_id',$model->id)->first()->basic_salary ?? '' ;
//            })

            ->editColumn('status', function ($model) {
                if ($model->status == 1) {
                    return trans('site.active');
                } else {
                    return trans('site.inactive');
                }
//                return (!empty($model->status)) ? $model->created_at->diffForHumans() : '';
            })
            ->editColumn('housing_allowance', function ($model) {
                if ($model->housing_allowance == 'Remotely') {
                    return trans('site.Remotely');
                } elseif ($model->housing_allowance == 'Office') {
                    return trans('site.Office');
                }
//                return (!empty($model->status)) ? $model->created_at->diffForHumans() : '';
            })
            ->addColumn('action', function ($model) {
                $actions = '';

                $actions .= DTHelper::dtEditButton(route($this->getRoutes()['update'], $model->id), trans('site.edit'), 'read_users');
                $actions .= DTHelper::dtDeleteButton(route($this->getRoutes()['delete'], $model->id), trans('site.delete'), 'read_users', $model->id);
                $actions .= DTHelper::dtShowButton(route($this->getRoutes()['show'], $model->id), trans('site.show'), 'read_users');
                $actions .= DTHelper::dtBlockActivateButton(route('dashboard.users.block', $model->id), trans('site.show'), 'read_users');

                return $actions;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\Branch  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model, Request $request)
    {
        if (auth()->user()->hasRole('Super Admin')) {
            if (! empty($this->request()->has('projects')) && ! empty($this->request()->has('companies')) && ! empty($this->request()->has('branches')) && ! empty($this->request()->has('categories'))) {
                $employee = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');
                $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employee)->whereIn('id', $employees)->whereIn('id', $employeess)->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('companies')) && ! empty($this->request()->has('categories'))) {
                $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employees)->whereIn('id', $employeess)->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('companies')) && ! empty($this->request()->has('categories'))) {
                $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employees)->whereIn('id', $employeess)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('branches')) && ! empty($this->request()->has('companies'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
                $branch = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employeess)->whereIn('id', $branch)->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('branches')) && ! empty($this->request()->has('companies'))) {
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
                $branch = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employeess)->whereIn('id', $branch)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('categories'))) {
                $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employees)->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('companies'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employeess)->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('branches'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');
                $branch = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $branch)->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('companies'))) {

//                dd("asmaa");

                $employeesss = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
//            dd($employeesss);
//            dd(User::where('types', 'Employee')->whereIn('id', $employeesss)->get());

                return User::where('types', 'Employee')->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('branches'))) {
                $employeesss = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('categories'))) {
                $employeesss = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');

                return $model->where('types', 'Employee')->whereIn('id', $employeesss)->newQuery();
            } else {
                return $model->where('types', 'Employee')->newQuery();
            }
        } else {
            return $model->where('user_id', Auth::id())->newQuery();
        }
    }

    public function count()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return User::where('types', 'Employee')->count();
        } else {
            return User::where('user_id', Auth::id())->where('types', 'Employee')->count();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('employee-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->text('<i class="fa fa-plus"></i> '.trans('site.add')),
                Button::make('csv')->text('<i class="fa fa-download"></i> '.trans('site.export')),
                Button::make('print')->text('<i class="fa fa-print"></i> '.trans('site.print')),
                Button::make('reset')->text('<i class="fa fa-undo"></i> '.trans('site.reset')),
                Button::make('reload')->text('<i class="fa fa-refresh"></i> '.trans('site.reload')),

            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('name')->title(trans('site.name')),
            Column::make('Termination_type')->title(trans('site.status')),
            Column::make('employee_end')->title(trans('site.employee_end_test')),
            Column::make('job')->title(trans('site.job')),
            Column::make('degree_job')->title(trans('site.degree_job')),
            Column::make('total_salary')->title(trans('site.penaltyss')),
            Column::make('housing_allowance')->title(trans('site.housing_allowancessssss')),
            Column::make('created_at')->title(trans('site.created_at')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')->title(trans('site.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Employee_'.date('YmdHis');
    }
}
