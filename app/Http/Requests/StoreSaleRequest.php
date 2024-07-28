<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreSaleRequest extends FormRequest
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
            'user_cpf' => 'required|exists:users,cpf',
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'final_price' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'user_cpf.required' => 'Campo user cpf é obrigatório',
            'user_cpf.exists' => 'Usuário não encontrado',
            'customer_id.required' => 'Campo customer id é obrigatório',
            'customer_id.exists' => 'Cliente não encontrado',
            'product_id.required' => 'Campo product id é obrigatório',
            'product_id.exists' => 'Produto não encontrado',
            'quantity.required' => 'Campo quantity é obrigatório',
            'quantity.integer' => 'Campo quantity deve ser um número inteiro',
            'final_price.required' => 'Campo final price é obrigatório',
            'final_price.numeric' => 'Campo final price deve ser um número',
        ];
    }
}
