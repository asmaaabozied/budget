<?php

namespace App\DataTables;

use App\Helpers\DTHelper;
use App\Models\CompanyEmployee;
use App\Models\SalaryWege;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SalaryWegesDataTable extends DataTable
{
    private $crudName = 'salaries_wages';

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
//            ->filter(function (Builder $query) use ($search) { // custom search
//                if ($this->request()->has('search')) {
//                    $query
//                        ->orWhere('users.name', 'LIKE', "%{$search}%")
//                        ->orWhere('users.father_name', 'LIKE', "%{$search}%")
//                        ->orWhere('users.family_name', 'LIKE', "%{$search}%")
//                        ->orWhereRaw("CONCAT(users.name,' ', users.father_name) LIKE '%{$search}%' ")
//                        ->orWhereRaw("CONCAT(users.name,' ', users.father_name,' ', users.family_name) LIKE '%{$search}%' ");
//                }
//            }, true)

//        $search = $this->request()->has('search') ? implode(",", $request->search) : '';
//        return datatables()
//            ->eloquent($query)
//            ->filter(function (Builder $query) use ($search) { // custom search
//                if ($this->request()->has('search')) {
//                    $query
//                        ->orWhere('users.name', 'LIKE', "%{$search}%")
//                        ->orWhere('users.father_name', 'LIKE', "%{$search}%")
//                        ->orWhere('users.family_name', 'LIKE', "%{$search}%")
//                        ->orWhereRaw("CONCAT(users.name,' ', users.father_name) LIKE '%{$search}%' ")
//                        ->orWhereRaw("CONCAT(users.name,' ', users.father_name,' ', users.family_name) LIKE '%{$search}%' ");
//                }
//            }, true)
            ->editColumn('created_at', function ($model) {
                return (! empty($model->created_at)) ? $model->created_at->diffForHumans() : '';
            })
            ->editColumn('employee_id', function ($model) {
                return $model->user->name.' '.$model->user->father_name.' '.$model->user->family_name;

//                return (!empty($model->employee_id)) ? $model->user->name    ?? ' ' . ' ' .   isset($model->user->father_name) ? $model->user->father_name .'  ' .$model->user->family_name   ?? '' : '' .' ' :'' ;
            })
            ->editColumn('id', function ($model) {
                return (! empty($model->employee_id)) ? SalaryWege::where('employee_id', $model->employee_id)->count() ?? ''.''.'' : '';
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

    public function query(SalaryWege $model)
    {
//        if (!empty($this->request()->has('date')) && !empty($this->request()->has('company_id'))) {
//
//
//            $employee = CompanyEmployee::where('company_id', $this->request()->get('company_id'))->pluck('employee_id');
//
//            if ($this->request()->get('company_id') == 0) {
//                return SalaryWege::where('hiring_date', '=', $this->request()->get('date'))->newQuery();
//
//            } else {
//
//
//                return SalaryWege::whereIn('employee_id', $employee)->where('hiring_date', '=', $this->request()->get('date'))->newQuery();
//            }
//
//        } elseif (!empty($this->request()->has('date'))) {
//
//            return SalaryWege::where('hiring_date', '=', $this->request()->get('date'))->newQuery();
//
//        } elseif (!empty($this->request()->has('company_id'))) {
//            $employee = CompanyEmployee::where('company_id', $this->request()->get('company_id'))->pluck('employee_id');
//
//            return SalaryWege::whereIn('employee_id', $employee)->newQuery();
//
//        } else {
        if (auth()->user()->hasRole('Super Admin')) {
            if (! empty($this->request()->has('date'))) {
                return $model->where('hiring_date', '!=', null)->where('transfer_month', $this->request()->get('date'))->newQuery();
            } else {
                return $model->where('hiring_date', '!=', null)->newQuery();
            }
        } else {
            return $model->where('user_id', Auth::id())->newQuery();
        }

//        }
    }

    public function count()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            if (! empty($this->request()->has('date'))) {
                return SalaryWege::where('hiring_date', '!=', null)->where('transfer_month', $this->request()->get('date'))->count();
            } else {
                return SalaryWege::where('hiring_date', '!=', null)->count();
            }
        } else {
            return SalaryWege::where('hiring_date', '!=', null)->where('user_id', Auth::id())->count();
        }
    }

    public function countEmployee()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            if (! empty($this->request()->has('date'))) {
                return SalaryWege::where('transfer_month', $this->request()->get('date'))->count();
            } else {
                return SalaryWege::count();
            }
        } else {
            return SalaryWege::where('user_id', Auth::id())->count();
        }
    }

    public function TotalSalary()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            if (! empty($this->request()->has('date'))) {
                return SalaryWege::where('transfer_month', $this->request()->get('date'))->sum('total_salary');
            } else {
                return SalaryWege::sum('total_salary');
            }
        } else {
            return SalaryWege::where('user_id', Auth::id())->sum('total_salary');
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
            ->setTableId('salaryweges-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
//                Button::make('create')->text('<i class="fa fa-plus"></i> ' . trans('site.addSalary')),
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
        return 'SalaryWeges_'.date('YmdHis');
    }
}
