<?php

namespace App\Http\Requests\ItemExtras;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemExtraRequest extends FormRequest
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
        ];
    }
}
