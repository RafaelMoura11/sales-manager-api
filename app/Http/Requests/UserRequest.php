<?php

// app/Http/Requests/UserRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'cpf' => 'required|unique:users,cpf',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.required' => 'Campo cpf é obrigatório',
            'cpf.unique' => 'Campo cpf deve ser único',
            'name.required' => 'Campo name é obrigatório',
            'email.required' => 'Campo email é obrigatório',
            'email.unique' => 'Campo email deve ser único',
            'email.email' => 'Campo email deve ser válido',
            'password.required' => 'Campo password é obrigatório',
            'password.min' => 'Campo password deve ter pelo menos 6 caracteres',
        ];
    }
}
