<?php

namespace App\Http\Requests\Categories;

use App\Enums\Status;
use App\Models\Menu;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'menu_id' => ['required', 'integer', Rule::exists(Menu::class, 'id')],
            'status' => ['required', 'integer', new EnumValue(Status::class)],
            'position' => ['required', 'integer', 'min:1'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'status' => (int)$this->status,
        ]);
    }
}
