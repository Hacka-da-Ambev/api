<?php

namespace App\Http\Requests;

use App\Rules\Base64Png;
use Illuminate\Foundation\Http\FormRequest;

class BeerRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'ibu' => 'required',
            'abv' => 'required',
            'image' => 'required',
            'image.name' => 'required',
            'image.base64' => ['required', new Base64Png()],
        ];
    }
}
