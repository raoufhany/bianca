<?php

namespace App\Http\Requests\Categories;

use App\Enums\Status;
use App\Models\Extra;
use App\Models\Menu;
use App\Models\Restaurant;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
            'position' => ['nullable', 'integer', 'min:1'],
            'item_name.*' => ['required', 'string', 'max:255'],
            'item_price.*' => ['required', 'numeric', 'min:0'],
            'item_description.*' => ['required', 'string', 'max:255'],
            'item_status.*' => ['required', 'integer', new EnumValue(Status::class)],
            'item_image.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'item_extra.*.*' => ['nullable', 'integer', Rule::exists(Extra::class, 'id')],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [
            'status' => (int)$this->status,
        ];

        if (isset($this->item_status)) {
            $itemStatuses = [];
            foreach ($this->item_status as $key => $status) {
                $itemStatuses[$key] = (int)$status;
            }

            $data = array_merge($data, ['item_status' => $itemStatuses,]);
        }

        $this->merge($data);
    }
}
