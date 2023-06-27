<?php

namespace App\Actions\Contracts\Tables;

use App\Models\Table;

interface UpdateTable
{
    public function handle(Table $table, array $data): void;
}
