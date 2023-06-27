<?php

namespace App\Actions\Categories;

use App\Actions\Contracts\Categories\UpdateCategory;
use App\Models\Category;
use App\Support\Image;

class UpdateCategoryAction implements UpdateCategory
{
    public function handle(Category $category, array $data): void
    {
        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/categories/';
            $data['image'] = Image::update($category->image, $data['image'], $filePath);
        }

        $category->update($data);
    }
}
