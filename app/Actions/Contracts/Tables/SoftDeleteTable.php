<?php

namespace App\Actions\Contracts\Tables;

use App\Models\Table;

interface SoftDeleteTable
{
    public function handle(Table $table): void;
}
