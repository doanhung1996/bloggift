<?php

namespace App\Composers;

use App\Domain\Page\Models\Page;
use App\Domain\Taxonomy\Models\Taxon;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class TaxonComposer
{
    /**
     * Bind data to view.
     */
    public function compose(View $view)
    {
        $taxons = Cache::rememberForever('taxon-menu', function () {
            $rootTaxon = Taxon::whereTaxonomyId(1)->whereNull('parent_id')->first();
            if (empty($rootTaxon)) {
                return [];
            }

            return Taxon::where('parent_id', $rootTaxon->id)
                ->ordered()
                ->with(['media', 'childs' => function ($q) {
                    $q->with(['childs' => function ($sub) {
                        $sub->with('media');
                    }]);
                }])->get();
        });
        $pages = Page::where('status', 1)->get();
        $view->withMenuTaxons($taxons);
        $view->withPageTaxons($pages);
    }
}
