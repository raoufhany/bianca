<?php

namespace App\Http\Requests\Items;

use App\Enums\Status;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Menu;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItemRequest extends FormRequest
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
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', Rule::exists(Category::class, 'id')],
            'status' => ['required', 'integer', new EnumValue(Status::class)],
            'extra.*' => ['nullable', 'integer', Rule::exists(Extra::class, 'id')],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => (int)$this->status,
        ]);
    }
}
