<?php

namespace App\DataTables;

use App\DataTables\Core\BaseDatable;
use App\Domain\Page\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class PageDataTable extends BaseDatable
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
            ->editColumn('status', 'admin.pages._tableStatus')
            ->editColumn('created_at', fn (Page $page) => formatDate($page->created_at))
            ->editColumn('updated_at', fn (Page $page) => formatDate($page->updated_at))
            ->addColumn('action', 'admin.pages._tableAction')
            ->rawColumns(['action', 'status']);
    }

    public function query(Page $model): Builder
    {
        return $model->newQuery();
    }

    protected function getColumns(): array
    {
        return [
            Column::checkbox(''),
            Column::make('id')->title(__('Index'))->data('DT_RowIndex')->searchable(false),
            Column::make('title')->title(__('Name')),
            Column::make('status')->title(__('Status')),
            Column::make('created_at')->title(__('Created At'))->searchable(false),
            Column::make('updated_at')->title(__('Updated At'))->searchable(false),
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
            'order' => [1, 'desc'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Page_'.date('YmdHis');
    }

    protected function getTableButton(): array
    {
        return [
            Button::make('bulkDelete')->addClass('btn bg-danger')->text('<i class="icon-trash mr-2"></i>'.__('Xóa')),
            Button::make('selectAll')->addClass('btn bg-blue')->text(__('Chọn tất cả')),
            Button::make('export')->addClass('btn btn-light')->text('<i class="icon-download mr-2"></i>'.__('Xuất')),
            Button::make('print')->addClass('btn btn-light')->text('<i class="icon-printer mr-2"></i>'.__('In')),
            Button::make('reset')->addClass('btn btn-light')->text('<i class="icon-reset mr-2"></i>'.__('Thiết lập lại')),
            Button::make('create')->addClass('btn btn-success')->text('<i class="icon-plus-circle2 mr-2"></i>'.__('Tạo mới')),
        ];
    }
}
