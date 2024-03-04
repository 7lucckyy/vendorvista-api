<?php

namespace App\Http\Requests\Api\Product\V1\Create;

use App\Http\Requests\Api\Base\BaseFormRequest;

class StoreProductRequest extends BaseFormRequest 
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'between:7,100'],
            'price' => ['required', 'string'],
            'quantity' => ['required', 'string'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name must be provided',
            'name.string' => 'Product name must be a string',
            'description.required' => 'Product must have a description',
            'description.between' => 'Product description must be between 7 and 100 characters',
            'price.required' => 'Product must have a price',
            'quantity.required' => 'Kindly define the product quantity in figures',
            'images.*.mimes' => 'Kindly upload pictures as JPG, JPEG, PNG format',
            'images.*.required' => 'Product images are required',
        ];
    }
}
