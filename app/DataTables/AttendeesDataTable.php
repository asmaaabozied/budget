<?php

namespace App\DataTables;

use App\Helpers\DTHelper;
use App\Models\Attendee;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AttendeesDataTable extends DataTable
{
    private $crudName = 'attendees';

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

            ->editColumn('period_id', function ($model) {
                return (! empty($model->period)) ? $model->period->name_ar : '';
            })
//            ->editColumn('employe_id', function ($model) {
//                return (!empty($model->employe_id)) ? $model->user->full_name : '';
//            })
            ->addColumn('action', function ($model) {
                $actions = '';

//                $actions .= DTHelper::dtEditButton(route($this->getRoutes()['update'], $model->id), trans('site.edit'), 'read_users');
//                $actions .= DTHelper::dtDeleteButton(route($this->getRoutes()['delete'], $model->id), trans('site.delete'), 'read_users', $model->id);
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
    public function query(Attendee $model)
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return $model->newQuery();
        } else {
            return $model->where('user_id', Auth::id())->newQuery();
        }
    }

    public function count()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Attendee::count();
        } else {
            return Attendee::where('user_id', Auth::id())->count();
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
            ->setTableId('attendees-table')
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
            Column::make('id'),
            Column::make('period_id')->title(trans('site.period_name')),
            Column::make('hour')->title(trans('site.hour')),
            Column::make('created_at')->title(trans('site.created_at')),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center')
                ->title(trans('site.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Attendees_'.date('YmdHis');
    }
}
