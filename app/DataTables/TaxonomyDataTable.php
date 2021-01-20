<?php

namespace App\DataTables;

use App\DataTables\Core\BaseDatable;
use App\Domain\Taxonomy\Models\Taxonomy;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class TaxonomyDataTable extends BaseDatable
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
            ->editColumn('created_at', fn(Taxonomy $taxonomy) => formatDate($taxonomy->created_at))
            ->editColumn('updated_at', fn(Taxonomy $taxonomy) => formatDate($taxonomy->updated_at))
            ->filterColumn('name', function($query, $keyword) {
                $query->where('name', "%{$keyword}%");
            })
            ->addColumn('action', 'admin.catalogs.taxonomies._tableAction');
    }

    public function query(Taxonomy $model): Builder
    {
        return $model->newQuery();
    }

    protected function getColumns(): array
    {
        return [
            Column::checkbox(''),
            Column::make('id')->title(__('STT'))->data('DT_RowIndex')->searchable(false),
            Column::make('name')->name('name')->title(__('Tên')),
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
            'order' => [2, 'desc'],
        ];
    }

    public function getTableButton(){
        return [];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Taxonomy_'.date('YmdHis');
    }

}
