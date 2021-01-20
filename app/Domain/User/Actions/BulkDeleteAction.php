<?php

declare(strict_types=1);

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;

class BulkDeleteAction
{
    public function execute(array $ids): int
    {
        $deletedRecord = User::whereIn('id', $ids)->where('id', '<>', 1)->delete();

        return $deletedRecord;
    }
}
