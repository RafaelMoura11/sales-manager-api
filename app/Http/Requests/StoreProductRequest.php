<?php

// app/Http/Requests/UserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422));
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo name é obrigatório',
            'name.string' => 'Campo name inválido',
            'name.max:255' => 'Limite de caracteres (255)',
            'category.required' => 'Campo category é obrigatório',
            'category.string' => 'Campo category inválido',
            'category.max:255' => 'Limite de caracteres (255)',
            'price.required' => 'Campo price é obrigatório',
            'price.numeric' => 'Campo price inválido',
        ];
    }
}
