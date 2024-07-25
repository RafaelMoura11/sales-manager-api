<?php

// app/Http/Requests/UpdateUserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->cpf . ',cpf',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.required' => 'Campo cpf é obrigatório',
            'cpf.exists' => 'O CPF fornecido não existe',
            'name.required' => 'Campo name é obrigatório',
            'email.required' => 'Campo email é obrigatório',
            'email.unique' => 'Campo email deve ser único',
            'email.email' => 'Campo email deve ser válido',
            'password.required' => 'Campo password é obrigatório',
            'password.min' => 'Campo password deve ter no mínimo 6 caracteres',
        ];
    }
}
