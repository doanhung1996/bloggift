<?php

namespace App\DataTables;

use App\DataTables\Core\BaseDatable;
use App\Domain\Admin\Models\Admin;
use Yajra\DataTables\Html\Column;

class AdminDataTable extends BaseDatable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('full_name', fn (Admin $admin) => view('admin.admins._tableFullName', compact('admin')))
            ->editColumn('created_at', fn (Admin $admin) => formatDate($admin->created_at))
            ->editColumn('updated_at', fn (Admin $admin) => formatDate($admin->updated_at))
            ->orderColumn('full_name',
                fn($query, $direction) => $query->orderByRaw("CONCAT(first_name, ' ', last_name) $direction")
            )
            ->addColumn('action', 'admin.admins._tableAction');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
        return $model->newQuery()->with('media', 'roles.translation');
    }

    protected function getColumns(): array
    {
        return [
            Column::checkbox(''),
            Column::make('id')->title(__('STT'))->data('DT_RowIndex')->searchable(false),
            Column::make('full_name')->title(__('Tên')),
            Column::make('email')->title(__('Email')),
            Column::make('created_at')->title(__('Thời gian tạo'))->searchable(false),
            Column::make('updated_at')->title(__('Thời gian cập nhật'))->searchable(false),
            Column::computed('action')
                ->title(__('Tác vụ'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function getBuilderParameters(): array
    {
        return [
            'order' => [5, 'desc'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Admin_'.date('YmdHis');
    }
}
