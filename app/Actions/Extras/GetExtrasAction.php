<?php

namespace App\Actions\Extras;

use App\Actions\Contracts\Extras\GetExtras;
use App\Models\Extra;
use Illuminate\Database\Eloquent\Builder;

class GetExtrasAction implements GetExtras
{

    /**
     * @return Builder
     */
    public function handle(): Builder
    {
        return Extra::query()->where('restaurant_id', session('restaurant.id'));
    }
}
