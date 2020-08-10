<?php
declare(strict_types=1);

namespace App\Domain\Taxonomy\Actions;


use App\Domain\Taxonomy\Models\Taxon;

class TaxonRenameAction
{
    public function execute(Taxon $taxon, string $name): void
    {
        $taxon->name = $name;

        $taxon->save();
    }
}
