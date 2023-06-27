<?php

namespace App\Actions\Contracts\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;

interface GetCategoryPositions
{
    public function handle(Category $category): Collection;
}
