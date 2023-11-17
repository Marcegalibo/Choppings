<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
	protected $rules = [
			'name'=> ['required', 'string'],
            'description_corta'=> ['required', 'string'],
            'description_larga'=> ['required', 'string'],
            'stock'=> ['required', 'numeric'],
            'category_id'=> ['required', 'exists:categories,id'],
            'cost'=> ['required', 'numeric'],
			'file' => ['required', 'image']
	];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return  $this->rules;
    }

    public function messages()
    {
        return [
            'name.required'=> 'El nombre es requerido.',
            'name.string'=> 'El nombre debe de ser valido',
            'description_corta.required'=> 'La descripciòn es requerida.',
            'description_corta.string'=> 'La descripciòn debe de ser valida',
            'description_larga.required'=> 'La descripciòn es requerida.',
            'description_larga.string'=> 'La descripciòn debe de ser valida',
            'stock.required'=> 'La cantidad es requerida.',
            'stock.numeric'=> 'La cantidad debe de ser un número valido',
            'category_id.required'=> 'La categoria es requerida.',
            'category_id.exists'=> 'La categoria no existe',
            'cost.required'=> 'El precio es requerido.',
            'cost.numeric'=> 'El precio debe de ser un número valido',
			'file.required'=> 'La imagen es requerida.',
            'file.image'=> 'El archivo debe de ser una imagen',
        ];
    }
}
