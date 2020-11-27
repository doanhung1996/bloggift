<?php

namespace App\Composers;

use App\Domain\Page\Models\Page;
use Illuminate\View\View;

class PageComposer
{
    /**
     * Bind data to view.
     */
    public function compose(View $view)
    {
        $pages = Page::where('status', 1)->get();
        $view->withPageTaxons($pages);
    }
}
