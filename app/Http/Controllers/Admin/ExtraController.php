<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Extras\StoreExtraRequest;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;

class ExtraController extends Controller
{
    public function store(StoreExtraRequest $storeExtraRequest): JsonResponse
    {
        $data = $storeExtraRequest->validated();

        $extra = Extra::query()->create($data);

        return response()->json(['id' => $extra->id, 'name' => $extra->name]);
    }
}
