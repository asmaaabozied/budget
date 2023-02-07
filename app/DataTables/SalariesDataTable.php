<?php

namespace App\DataTables;

use App\Helpers\DTHelper;
use App\Models\Salary;
use App\Models\SalaryWege;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalariesDataTable extends DataTable
{
    private $crudName = 'salaries_wages';

    private function getRoutes()
    {
        return [
            'update' => "dashboard.$this->crudName.edit",
            'delete' => "dashboard.$this->crudName.destroy",
            'block' => "dashboard.$this->crudName.block",
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
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($model) {
                return (! empty($model->created_at)) ? $model->created_at->diffForHumans() : '';
            })
            ->editColumn('employee_id', function ($model) {
                return $model->user->name.' '.$model->user->father_name.' '.$model->user->family_name;
            })
            ->addColumn('action', function ($model) {
                $actions = '';
                $actions .= DTHelper::dtPrintButton(route('dashboard.salaryPdf', $model->id), trans('site.edit'), 'read_users');

                $actions .= DTHelper::dtEditButton(route($this->getRoutes()['update'], $model->id), trans('site.edit'), 'read_users');
                $actions .= DTHelper::dtDeleteButton(route($this->getRoutes()['delete'], $model->id), trans('site.delete'), 'read_users', $model->id);
                $actions .= DTHelper::dtShowButton(route($this->getRoutes()['show'], $model->id), trans('site.show'), 'read_users');

                return $actions;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\Rating  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SalaryWege $model, Request $request)
    {
        if (auth()->user()->hasRole('Super Admin')) {
            if (! empty($this->request()->has('projects')) && ! empty($this->request()->has('companies')) && ! empty($this->request()->has('branches')) && ! empty($this->request()->has('categories'))) {
                $employee = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');
                $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

                return $model->whereIn('employee_id', $employee)->whereIn('employee_id', $employees)->whereIn('employee_id', $employeess)->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('branches')) && ! empty($this->request()->has('companies'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
                $branch = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->whereIn('employee_id', $employeess)->whereIn('employee_id', $branch)->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('branches')) && ! empty($this->request()->has('companies'))) {
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');
                $branch = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->whereIn('employee_id', $employeess)->whereIn('employee_id', $branch)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('categories'))) {
                $employees = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

                return $model->whereIn('employee_id', $employees)->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('companies'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');
                $employeess = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');

                return $model->whereIn('employee_id', $employeess)->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects')) && ! empty($this->request()->has('branches'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');
                $branch = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->whereIn('employee_id', $branch)->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('companies'))) {
                $employeesss = DB::table('company_employee')->where('company_id', $request->companies)->pluck('employee_id');

                return $model->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('branches'))) {
                $employeesss = DB::table('branch_employee')->where('branch_id', $request->branches)->pluck('employee_id');

                return $model->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('projects'))) {
                $employeesss = DB::table('project_employee')->where('project_id', $request->projects)->pluck('employee_id');

                return $model->whereIn('employee_id', $employeesss)->newQuery();
            } elseif (! empty($this->request()->has('categories'))) {
                $employeesss = DB::table('category_employee')->where('category_id', $request->categories)->pluck('employee_id');

                return $model->whereIn('employee_id', $employeesss)->newQuery();
            } else {
                return $model->newQuery();
            }
        } else {
            return $model->where('user_id', Auth::id())->newQuery();
        }
    }

    public function count()
    {
//        if (!empty($this->request()->has('companies'))) {
//
//            $employeesss = DB::table('company_employee')->where('company_id', $this->request()->has('companies'))->pluck('employee_id');
//
//            return SalaryWege::whereIn('employee_id', $employeesss)->count();
//
//
//        } elseif (!empty($this->request()->has('branches'))) {
//
//            $employeesss = DB::table('branch_employee')->where('branch_id', $this->request()->has('branches'))->pluck('employee_id');
//
//            return SalaryWege::whereIn('employee_id', $employeesss)->count();
//
//
//        } elseif (!empty($this->request()->has('projects'))) {
//
//            $employeesss = DB::table('project_employee')->where('project_id', $this->request()->has('projects'))->pluck('employee_id');
//
//            return SalaryWege::whereIn('employee_id', $employeesss)->count();
//
//
//        } elseif (!empty($this->request()->has('categories'))) {
//
//            $employeesss = DB::table('category_employee')->where('category_id', $this->request()->has('categories'))->pluck('employee_id');
//
//            return SalaryWege::whereIn('employee_id', $employeesss)->count();
//
//
//        } else {
        if (auth()->user()->hasRole('Super Admin')) {
            return SalaryWege::count();
        } else {
            return SalaryWege::where('user_id', Auth::id())->count();
        }

//        }
    }

    public function countEmployee()
    {

//        if (!empty($this->request()->has('date'))) {
//
//            return SalaryWege::where('transfer_month', $this->request()->get('date'))->count();
//
//        } else {
        if (auth()->user()->hasRole('Super Admin')) {
            return SalaryWege::count();
        } else {
            return SalaryWege::where('user_id', Auth::id())->count();
        }

//        }
    }

    public function TotalSalary()
    {

//        if (!empty($this->request()->has('date'))) {
//
//            return SalaryWege::where('transfer_month', $this->request()->get('date'))->sum('total_salary');
//
        ////        } else {
        ///
//

        if (auth()->user()->hasRole('Super Admin')) {
            return SalaryWege::sum('total_salary');
        } else {
            return SalaryWege::where('user_id', Auth::id())->sum('total_salary');
        }
//
//        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('salaries-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
//                Button::make('create')->text('<i class="fa fa-plus"></i> ' . trans('site.add')),
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
            Column::make('employee_id')->title(trans('site.nameemployee')),

            Column::make('id')->title(trans('site.numberemployee')),
            Column::make('transfer_month')->title(trans('site.hiring_date')),

//            Column::make('basic_salary')->title(trans('site.basic_salary')),
            Column::make('total_salary')->title(trans('site.penaltyss')),

            Column::make('hiring_date')->title(trans('site.transfer_months')),

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
        return 'Salaries_'.date('YmdHis');
    }
}
