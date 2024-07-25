<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteUserRequest extends FormRequest
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
            'cpf' => 'required|exists:users,cpf',
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.required' => 'Campo cpf é obrigatório',
            'cpf.exists' => 'O CPF fornecido não existe',
        ];
    }
}
