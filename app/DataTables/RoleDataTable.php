<?php

namespace App\DataTables;

use App\DataTables\Core\BaseDatable;
use App\Domain\Acl\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class RoleDataTable extends BaseDatable
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
            ->editColumn('created_at', fn(Role $admin) => formatDate($admin->created_at))
            ->editColumn('updated_at', fn(Role $admin) => formatDate($admin->updated_at))
            ->orderColumn('display_name', function ($query, $order) {
                $query->orderByTranslation('display_name', $order);
            })
            ->filterColumn('display_name', function($query, $keyword) {
                $query->whereTranslationLike('display_name', "%{$keyword}%");
            })
            ->addColumn('action', 'admin.roles._tableAction');
    }

    public function query(Role $model): Builder
    {
        return $model->newQuery()->with('translation');
    }

    protected function getColumns(): array
    {
        return [
            Column::checkbox(''),
            Column::make('id')->title(__('Index'))->data('DT_RowIndex')->searchable(false),
            Column::make('translation.display_name')->name('display_name')->title(__('Tên')),
            Column::make('created_at')->title(__('Thời gian tạo'))->searchable(false),
            Column::make('updated_at')->title(__('Thời gian cập nhật'))->searchable(false),
            Column::computed('action')
                ->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function getBuilderParameters(): array
    {
        return [
            'order' => [3, 'desc'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Role_'.date('YmdHis');
    }
}
