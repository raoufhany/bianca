<?php

namespace App\Actions\Contracts\Categories;

use App\Models\Category;

interface SoftDeleteCategory
{
    public function handle(Category $category): void;
}
