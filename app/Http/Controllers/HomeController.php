<?php

namespace App\Http\Controllers;

use App\Domain\Post\Models\Post;
use App\Enums\StatusPost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!empty(request('q'))){
            $posts = Post::where('title', 'like', request('q')."%")->where('status', StatusPost::Active)->latest()->limit(10)->get();
            return view('blog.home', compact('posts'));
        }
        $posts = Post::where('status', StatusPost::Active)->latest()->limit(10)->get();
        return view('blog.home', compact('posts'));
    }

    public function loadMore()
    {
        if (request('q')){
            $posts = Post::where('title', 'like', request('q')."%")->where('status', StatusPost::Active)->paginate(10);
            return response()->json([
                'view' => view('blog.load_more', compact('posts'))->render(),
                'is_last_page_post' => $posts->lastPage() == request('page') || $posts->lastPage() < request('page') ? true : false
            ]);
        }
        $posts = Post::where('status', StatusPost::Active)->paginate(10);
        return response()->json([
            'view' => view('blog.load_more', compact('posts'))->render(),
            'is_last_page_post' => $posts->lastPage() == request('page') || $posts->lastPage() < request('page') ? true : false
        ]);
    }
}
