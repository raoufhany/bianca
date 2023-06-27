<?php

namespace App\Actions\Contracts\Categories;

use App\Models\Category;

interface UpdateCategory
{
    public function handle(Category $category, array $data): void;
}
