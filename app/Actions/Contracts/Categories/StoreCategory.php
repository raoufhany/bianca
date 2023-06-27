<?php

namespace App\Actions\Contracts\Categories;

use App\Actions\Contracts\Items\StoreItem;
use App\Models\Category;

interface StoreCategory
{
    public function __construct(StoreItem $storeItem);

    public function handle(array $data): Category;
}
