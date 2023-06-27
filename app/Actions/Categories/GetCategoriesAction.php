<?php

namespace App\Actions\Categories;

use App\Actions\Contracts\Categories\GetCategories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class GetCategoriesAction implements GetCategories
{
    public function handle(): Builder
    {
        return Category::query();
    }
}
