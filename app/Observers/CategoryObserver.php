<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param Category $category
     * @return void
     */
    public function created(Category $category): void
    {
        if (is_null($category->position)) {
            $category->position = Category::where('menu_id', $category->menu_id)->max('position') + 1;
            $category->saveQuietly();
            return;
        }

        $lowerPriorityCategories = Category::where('menu_id', $category->menu_id)
            ->where('position', '>=', $category->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->position++;
            $lowerPriorityCategory->saveQuietly();
        }
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param Category $category
     * @return void
     */
    public function updated(Category $category): void
    {
        if ($category->isClean('position')) {
            return;
        }

        if (is_null($category->position)) {
            $category->position = Category::where('menu_id', $category->menu_id)->max('position');
        }

        if ($category->getOriginal('position') > $category->position) {
            $positionRange = [
                $category->position, $category->getOriginal('position')
            ];
        } else {
            $positionRange = [
                $category->getOriginal('position'), $category->position
            ];
        }

        $lowerPriorityCategories = Category::where('menu_id', $category->menu_id)
            ->where('id', '!=', $category->id)
            ->whereBetween('position', $positionRange)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            if ($category->getOriginal('position') < $category->position) {
                $lowerPriorityCategory->position--;
            } else {
                $lowerPriorityCategory->position++;
            }
            $lowerPriorityCategory->saveQuietly();
        }
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function deleted(Category $category): void
    {
        $lowerPriorityCategories = Category::where('menu_id', $category->menu_id)
            ->where('position', '>', $category->position)
            ->get();

        foreach ($lowerPriorityCategories as $lowerPriorityCategory) {
            $lowerPriorityCategory->position--;
            $lowerPriorityCategory->saveQuietly();
        }
    }

    /**
     * Handle the Category "restored" event.
     *
     * @param Category $category
     * @return void
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param Category $category
     * @return void
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
