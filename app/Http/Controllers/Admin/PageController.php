<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PageDataTable;
use App\Domain\Page\Models\Page;
use App\Http\Requests\Admin\PageRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController
{

    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.index');
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function store(PageRequest $request)
    {
        $page = Page::create($request->validated());
        flash()->success(__('Trang ":model" đã tạo thành công !', ['model' => $page->title]));

        return redirect()->route('admin.pages.index');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Page $page, PageRequest $request)
    {
        $page->update($request->validated());
        flash()->success(__('Trang đã cập nhật thành công !'));

        return redirect()->route('admin.pages.index');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json([
           'success' => true,
           'message' => __('Trang đã xóa thành công !'),
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $deletedRecord = Page::whereIn('id', $request->input('id'))->delete();

        return response()->json([
            'status' => true,
            'message' => __('Đã xóa ":count" records', ['count' => $deletedRecord]),
        ]);
    }

    public function changeStatus(Page $page, Request $request)
    {
        $page->update(['status' => $request->state]);

        return response()->json([
            'status' => true,
            'message' => __('Cập nhật trạng thái thành công !'),
        ]);
    }
}
