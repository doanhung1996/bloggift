<?php

namespace App\Http\Controllers;

use App\Domain\Page\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return view('page.show', compact('page'));
    }
}
