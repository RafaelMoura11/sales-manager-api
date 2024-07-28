<?php

// app/Http/Requests/UserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:customers,email,' . $this->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo name é obrigatório',
            'name.string' => 'Campo name inválido',
            'name.max:255' => 'Limite de caracteres (255)',
            'email.required' => 'Campo email é obrigatório',
            'email.unique' => 'Email já existe',
            'email.email' => 'Campo email deve ser válido',
        ];
    }
}
