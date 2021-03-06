<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\DataTables\PostDataTable;
use App\Domain\Post\Models\Post;
use App\Http\Requests\Admin\PostBulkDeleteRequest;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController
{
    use AuthorizesRequests;

    public function index(PostDataTable $dataTable)
    {
        $this->authorize('view', Post::class);

        return $dataTable->render('admin.posts.index');
    }

    public function create(): View
    {
        $this->authorize('create', Post::class);

        return view('admin.posts.create');
    }

    public function store(PostStoreRequest $request)
    {
        $this->authorize('create', Post::class);
        $data = $request->except(['category', 'file', 'image', 'new_images']);
        $data['user_id'] = auth()->user()->id;
        $post = Post::create($data);
        if ($request->hasFile('image')) {
            $post->addMedia($request->image)->toMediaCollection('image');
        }
        if ($request->hasFile('file')) {
            $post->addMedia($request->file)->toMediaCollection('file');
        }
        foreach ($request->input('new_images', []) as $image) {
            $post->addMediaFromDisk($image)->toMediaCollection();
        }
        $post->taxons()->attach($request->input('category'));
        flash()->success(__('Bài viết ":model" đã được tạo thành công !', ['model' => $post->title]));

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', $post);
        $post->load([
            'taxons' => function ($query) {
                $query->with(['ancestors' => function ($q) {
                    $q->breadthFirst();
                }]);
            },
        ]);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        $this->authorize('update', $post);

        if ($request->hasFile('image')) {
            $post->addMedia($request->image)->toMediaCollection('image');
        }
        if ($request->hasFile('file')) {
            $post->addMedia($request->file)->toMediaCollection('file');
        }

        $post->update($request->except(['category', 'file', 'image', 'images', 'new_images']));
        // Remove media if not provide
        foreach ($post->getMedia() as $media) {
            if (! in_array($media->id, $request->input('images', []))) {
                $media->delete();
            }
        }
        // Create new media
        foreach ($request->input('new_images', []) as $image) {
            $post->addMediaFromDisk($image)->toMediaCollection();
        }
        $post->taxons()->sync($request->input('category'));

        flash()->success(__('Bài viết đã được cập nhật !'));

        return redirect()->route('admin.posts.edit', $post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'status' => true,
            'message' => __('Bài viết đã bị xóa !'),
        ]);
    }

    public function bulkDelete(PostBulkDeleteRequest $request)
    {
        $deletedRecord = Post::whereIn('id', $request->input('id'))->delete();

        return response()->json([
            'status' => true,
            'message' => __('Đã xóa ":count" bản ghi', ['count' => $deletedRecord]),
        ]);
    }

    public function changeStatus(Post $post, Request $request)
    {
        $post->update(['status' => $request->status]);
        return response()->json([
            'status' => true,
            'message' => __('Bài viết đã được cập nhật trạng thái thành công !'),
        ]);
    }

    public function bulkStatus(Request $request)
    {
        $total = Post::whereIn('id', $request->id)->update(['status' => $request->status]);

        return response()->json([
            'status' => true,
            'message' => __(':count bài viết đã được cập nhật trạng thái thành công !', ['count' => $total]),
        ]);
    }

    public function upLoadFileImage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => ['mimes:jpeg,jpg,png', 'required', 'max:2048'],
            ],
            [
                'file.mimes' => __('File upload is invalid'),
                'file.max' => __('File too big'),
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('file'),
            ], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $file = $request->file('file')->storePublicly('tmp/uploads');

        return response()->json([
            'file' => $file,
            'status' => true,
        ]);
    }
}
