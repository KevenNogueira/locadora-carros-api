<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cpf' => 'required|min:11|max:11|unique:clientes,cpf',
            'nome' => 'required|min:3|max:50',
            'email' => 'required|min:10|max:100|unique:clientes,email|email',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O campo :attribute já foi cadastrado no banco',
            'cpf.min' => 'O CPF deve conter no minimo 11 caracteres',
            'cpf.max' => 'O CPF deve conter no máximo 11 caracteres',
            'nome.min' => 'O nome deve conter no minimo 03 caracteres',
            'nome.max' => 'O nome deve conter no máximo 50 caracteres',
            'email.min' => 'O email deve conter no minimo 10 caracteres',
            'email.max' => 'O email deve conter no máximo 100 caracteres',
        ];
    }
}