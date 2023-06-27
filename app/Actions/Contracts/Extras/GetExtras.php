<?php

namespace App\Actions\Contracts\Extras;

use Illuminate\Database\Eloquent\Builder;

interface GetExtras
{
    public function handle(): Builder;
}
