<?php

namespace App\Actions\Contracts\Tables;

interface StoreTable
{
    public function handle(array $data): void;
}
