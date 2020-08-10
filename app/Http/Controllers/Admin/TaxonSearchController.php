<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Taxonomy\Models\Taxon;
use Illuminate\Http\Request;

class TaxonSearchController
{
    public function __invoke(Request $request)
    {
        $query = Taxon::query()
            ->with(['ancestors' => function ($q) {
                $q->breadthFirst();
            }])
            ->whereNotNull('parent_id');
//            ->where('name', 'LIKE', $request->query('q').'%');
//        if ($request->query('type', 'product_taxonomy') == 'product_taxonomy'){
//            $query->where('taxonomy_id', settings('product_taxonomy', 1));
//        }else{
//            $query->where('taxonomy_id', settings('post_taxonomy', 2));
//        }
        $taxons = $query->paginate();

        $taxons->getCollection()->transform(function ($taxon) {
            $result = [
                'id' => $taxon->id,
            ];
            $prettyName = '';
            if ($taxon->ancestors->isNotEmpty()) {
                foreach ($taxon->ancestors as $ancestor) {
                    $prettyName .= $ancestor->name.' -> ';
                }
            }
            $prettyName .= $taxon->name;
            $result['pretty_name'] = $prettyName;

            return $result;
        });

        return response()->json($taxons);
    }
}
