<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TaxonomyRequest;
use App\DataTables\TaxonomyDataTable;
use App\Domain\Taxonomy\Actions\TaxonomyCreateAction;
use App\Domain\Taxonomy\Actions\TaxonomyDeleteAction;
use App\Domain\Taxonomy\Models\Taxonomy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaxonomyController
{
    use AuthorizesRequests;

    public function index(TaxonomyDataTable $dataTable)
    {
        $this->authorize('view', Taxonomy::class);

        return $dataTable->render('admin.catalogs.taxonomies.index');
    }

    public function create(): View
    {
        $this->authorize('create', Taxonomy::class);

        return view('admin.catalogs.taxonomies.create');
    }

    public function store(TaxonomyRequest $request, TaxonomyCreateAction $action): RedirectResponse
    {
        $this->authorize('create', Taxonomy::class);

        $taxonomy = $action->execute($request->validated());

        flash()->success(__('Taxonomy ":model" has been successfully created!', ['model' => $taxonomy->name]));

        return redirect()->route('admin.taxonomies.edit', $taxonomy->id);
    }

    public function edit(Taxonomy $taxonomy): View
    {
        $this->authorize('update', $taxonomy);

        return view('admin.catalogs.taxonomies.edit', compact('taxonomy'));
    }

    public function update(TaxonomyRequest $request, Taxonomy $taxonomy): RedirectResponse
    {
        $this->authorize('update', $taxonomy);

        $taxonomy->update($request->validated());

        flash()->success(__('Taxonomy ":model" has been successfully updated!', ['model' => $taxonomy->name]));

        return intended($request, route('admin.taxonomies.edit', $taxonomy));
    }

    public function destroy(Taxonomy $taxonomy, TaxonomyDeleteAction $action): JsonResponse
    {
        $this->authorize('delete', $taxonomy);

        $action->execute($taxonomy);

        return response()->json([
            'status' => true,
            'message' => __('Taxonomy ":model" has been successfully deleted!', ['model' => $taxonomy->name])
        ]);
    }


    public function bulkDelete()
    {}
}
