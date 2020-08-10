<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TaxonStoreRequest;
use App\Http\Requests\Admin\TaxonUpdateRequest;
use App\Domain\Taxonomy\Actions\TaxonCreateAction;
use App\Domain\Taxonomy\Actions\TaxonDeleteAction;
use App\Domain\Taxonomy\Actions\TaxonUpdateAction;
use App\Domain\Taxonomy\DTO\TaxonCreateData;
use App\Domain\Taxonomy\DTO\TaxonUpdateData;
use App\Domain\Taxonomy\Models\Taxon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaxonController
{
    use AuthorizesRequests;

    public function store(TaxonStoreRequest $request, TaxonCreateAction $action): JsonResponse
    {
        $this->authorize('create', Taxon::class);

        $taxonData = TaxonCreateData::fromRequest($request);

        $taxon = $action->execute($taxonData);

        return response()->json([
            'id' => $taxon->id,
        ]);
    }

    public function edit(Taxon $taxon): View
    {
        $taxon->load( 'media');
        return view('admin.catalogs.taxons.edit', compact('taxon'));
    }

    public function update(TaxonUpdateRequest $request, Taxon $taxon, TaxonUpdateAction $action)
    {
        $this->authorize('update', $taxon);

        $updateData = TaxonUpdateData::fromRequest($request);

        $action->execute($taxon, $updateData);

        flash()->success(__('Taxon ":model" has been successfully updated!', ['model' => $taxon->name]));

        return redirect()->back();
    }

    public function destroy(Taxon $taxon, TaxonDeleteAction $action): JsonResponse
    {
        $this->authorize('delete', $taxon);

        $action->execute($taxon);

        return response()->json([
            'status' => true,
            'message' => __('Taxon ":model" has been successfully deleted!', ['model' => $taxon->name])
        ]);
    }
}
