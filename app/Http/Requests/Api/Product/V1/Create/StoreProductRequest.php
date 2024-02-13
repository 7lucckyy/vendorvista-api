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
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg'],        ];
        
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name must be provided',
            'name.string' => 'Product name must be string',
            'description.required' => 'Product must have description',
            'description.between' => 'Product description must be between 7 and 100 characters',
            'price.required' => 'Product must have Price',
            'quantity.required' => 'kindly define the product quantity in figures',
            'image.mimes' => 'Kindly upload picture as JPG, JPEG, PNG format',
            'image.required' => 'Product image is required' 
        ];
    }
}