<?php

namespace App\Actions\Contracts\Categories;

use Illuminate\Database\Eloquent\Builder;

interface GetCategories
{
    public function handle(): Builder;
}
