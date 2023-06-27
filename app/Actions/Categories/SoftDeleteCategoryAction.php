<?php

namespace App\Actions\Categories;

use App\Actions\Contracts\Categories\SoftDeleteCategory;
use App\Models\Category;

class SoftDeleteCategoryAction implements SoftDeleteCategory
{
    public function handle(Category $category): void
    {
        $category->delete();
    }
}
