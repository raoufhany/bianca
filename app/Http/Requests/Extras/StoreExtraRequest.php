<?php

namespace App\Http\Requests\Extras;

use App\Models\Item;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExtraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'user_id' => ['required', 'integer', Rule::exists(User::class, 'id')],
            'restaurant_id' => ['required', 'integer', Rule::exists(Restaurant::class, 'id')],
        ];
    }
}
