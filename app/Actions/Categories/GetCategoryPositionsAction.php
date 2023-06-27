<?php

namespace App\Actions\Categories;

use App\Actions\Contracts\Categories\GetCategoryPositions;
use App\Models\Category;
use Illuminate\Support\Collection;

class GetCategoryPositionsAction implements GetCategoryPositions
{
    public function handle(Category $category): Collection
    {
        return Category::query()
            ->where('menu_id', $category->menu_id)
            ->orderBy('position')
            ->pluck('position');
    }
}
