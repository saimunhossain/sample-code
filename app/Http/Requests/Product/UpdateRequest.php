<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'age_id' => 'required',
            'price' => 'required|numeric|between:0,9999.99',
            'stock' => 'required',
            'qty' => 'required|numeric',
            'total_page_number' => 'required|numeric',
            'description' => 'required',
            'best_for_age' => 'required',
            'cover_type' => 'required',
            'shipping_day_from' => 'nullable',
            'shipping_day_to' => 'nullable',
            'family' => 'nullable',
            'festival' => 'nullable',
            'others' => 'nullable',
            'image_url' => 'nullable',
            'imageFile' => 'nullable'
        ];
    }
}
