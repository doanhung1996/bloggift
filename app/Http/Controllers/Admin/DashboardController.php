<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;
use App\Domain\Post\Models\Post;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use Analytics;

class DashboardController
{
    public function index()
    {
        $totalPosts = Post::count();

        return view('admin.dashboard', compact( 'totalPosts'));
    }
}
