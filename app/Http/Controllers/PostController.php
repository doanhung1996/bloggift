<?php

namespace App\Http\Controllers;

use App\Domain\Post\Models\Post;
use App\Domain\Taxonomy\Models\Taxon;
use App\Enums\StatusPost;
use App\Enums\TypePost;

class PostController extends Controller
{
    public function index()
    {
        if (request('category')){
            $category = Taxon::whereSlug(request('category'))->with(['ancestors' => function ($sub) {
                $sub->whereNotNull('parent_id')->breadthFirst();
            }])->firstOrFail();
            $posts = Post::whereHas('taxons', function($q) use($category){
                $q->where('id', $category->id);
            })->where('status', StatusPost::Active)->latest()->limit(10)->get();
            return view('blog.post.index', compact('posts', 'category'));
        }
        abort(404);
    }

    public function show(Post $post)
    {
        $postNews = Post::where('status', StatusPost::Active)->take(4)->get();
        $post->increment('view');
        if ($post->type == TypePost::LESSON){
            if (auth('web')->check()){
                return view('blog.post.show_lesson', compact('post', 'postNews'));
            }
                return redirect()->guest('login');
        }
        return view('blog.post.show', compact('post', 'postNews'));
    }

    public function loadMore($slug)
    {
        $category = Taxon::whereSlug($slug)->with(['ancestors' => function ($sub) {
            $sub->whereNotNull('parent_id')->breadthFirst();
        }])->firstOrFail();
        $posts = Post::whereHas('taxons', function($q) use($category){
            $q->where('id', $category->id);
        })->where('status', StatusPost::Active)->paginate(10);
        return response()->json([
            'view' => view('blog.post.load_more', compact('posts'))->render(),
            'is_last_page_post' => $posts->lastPage() == request('page') || $posts->lastPage() < request('page') ? true : false
        ]);
    }
}
