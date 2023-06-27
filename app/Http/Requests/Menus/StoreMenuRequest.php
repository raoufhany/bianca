<?php

namespace App\Http\Requests\Menus;

use App\Enums\Status;
use App\Models\Restaurant;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'restaurant_id' => ['required', 'integer', Rule::exists(Restaurant::class, 'id')],
//            'status' => ['required', 'integer', new EnumValue(Status::class)],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => (int)$this->status,
        ]);
    }
}
