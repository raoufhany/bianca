<?php

namespace App\Actions\Tables;

use App\Models\Table;
use App\Actions\Contracts\Tables\SoftDeleteTable;

class SoftDeleteTableAction implements SoftDeleteTable
{
    public function handle(Table $table): void
    {
        $table->delete();
    }
}
