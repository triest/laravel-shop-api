<?php

namespace App\Http\Requests;

use App\Rules\FilterPriceRule;
use Illuminate\Foundation\Http\FormRequest;

class RequestProductFilter extends FormRequest
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
                "category_id" => "array",
                "name.*" => "required|exists:App\Models\Category,id",
                'price_min' => [new FilterPriceRule($this)],
                'price_max' => 'numeric|min:0'
        ];
    }
}
