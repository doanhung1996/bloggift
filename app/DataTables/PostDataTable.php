<?php

namespace App\DataTables;

use App\DataTables\Core\BaseDatable;
use App\Domain\Post\Models\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class PostDataTable extends BaseDatable
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
            ->addColumn('title', fn (Post $post) => view('admin.posts._tableFullName', compact('post')))
            ->addColumn('type', fn (Post $post) => view('admin.posts._tableType', compact('post')))
            ->editColumn('status','admin.posts._tableStatus')
            ->editColumn('created_at', fn (Post $post) => formatDate($post->created_at))
            ->editColumn('updated_at', fn (Post $post) => formatDate($post->updated_at))
            ->addColumn('action', 'admin.posts._tableAction')
            ->rawColumns(['action', 'title', 'type', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
    {
        return $model->newQuery()->with('user');
    }

    protected function getColumns(): array
    {
        return [
            Column::checkbox(''),
            Column::make('id')->title(__('STT'))->data('DT_RowIndex')->searchable(false),
            Column::make('title')->title(__('Tên')),
            Column::make('view')->title(__('Lượt xem')),
            Column::make('type')->title(__('Kiểu bài viết')),
            Column::make('status')->title(__('Trạng thái')),
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

    protected function getTableButton(): array
    {
        return [
            Button::make('selected')->addClass('btn bg-teal-400')
                ->text('<i class="icon-magic-wand mr-2"></i>'.__('Cập nhật trạng thái'))
                ->action("
                    var selectedRow = dt.rows( { selected: true } ).data();
                    var selectedId = [];
                    for (var i=0; i < selectedRow.length ;i++){
                        selectedId.push(selectedRow[i].id);
                    }

                    var bulkUrl = window.location.href.replace(/\/+$/, \"\") + '/bulk-status';

                    bootbox.dialog({
                    title: 'Cập nhật trạng thái',
                    message: '<div class=\"row\">  ' +
                        '<div class=\"col-md-12\">' +
                            '<form action=\"\">' +
                                '<div class=\"form-group row\">' +
                                    '<label class=\"col-md-4 col-form-label\">Trạng thái</label>' +
                                    '<div class=\"col-md-8\">' +
                                        '<select class=\"form-control\" id=\"change-state\">' +
			                                '<option value=\"pending\">Chờ phê duyệt</option>' +
			                                '<option value=\"active\">Hoạt động</option>' +
			                                '<option value=\"disabled\">Hủy</option>' +
			                            '</select>' +
                                    '</div>' +
                                '</div>' +
                            '</form>' +
                        '</div>' +
                    '</div>',
                    buttons: {
                        success: {
                            label: 'Lưu',
                            className: 'btn-success',
                            callback: function () {
                                var status = $('#change-state').val();
                                $.ajax({
                                    type: 'POST',
                                    data: {
                                        id: selectedId,
                                        status: status
                                    },
                                    url: bulkUrl,
                                    success: function (res) {
                                        dt.ajax.reload()
                                        if(res.status == true){
                                            showMessage('success', res.message);
                                        }else{
                                            showMessage('error', res.message);
                                        }
                                    },
                                })
                            }
                        }
                    }
                }
            );"),
            Button::make('bulkDelete')->addClass('btn bg-danger')->text('<i class="icon-trash mr-2"></i>'.__('Xóa')),
            Button::make('selectAll')->addClass('btn bg-blue')->text(__('Chọn tất cả')),
            Button::make('export')->addClass('btn btn-light')->text('<i class="icon-download mr-2"></i>'.__('Xuất')),
            Button::make('print')->addClass('btn btn-light')->text('<i class="icon-printer mr-2"></i>'.__('In')),
            Button::make('reset')->addClass('btn btn-light')->text('<i class="icon-reset mr-2"></i>'.__('Thiết lập lại')),
            Button::make('create')->addClass('btn btn-success')->text('<i class="icon-plus-circle2 mr-2"></i>'.__('Tạo mới')),
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
        return 'Post_'.date('YmdHis');
    }
}
