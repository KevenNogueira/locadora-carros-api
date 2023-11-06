<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModeloRequest extends FormRequest
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
            'num_modelo' => 'required|min:6|max:6|unique:modelos,num_modelo',
            'cnpj_marca' => 'required|exists:marcas,cnpj|min:14|max:14',
            'imagem' => 'required|image|max:100',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,57',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'

        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'cnpj_marca.exists' => 'O CNPJ informado não existe no banco de dados',
            'cnpj_marca.min' => 'O CNPJ deve conter no minimo 14 caracteres',
            'cnpj_marca.max' => 'O CNPJ deve conter no máximo 14 caracteres',
            'num_modelo.min' => 'O numero do modelo deve conter no minimo 6 caracteres',
            'num_modelo.max' => 'O numero do modelo deve conter no máximo 6 caracteres',
            'imagem.max' => 'A imagem deve ter no máximo 100kb',
            'imagem.image' => 'O arquivo deve ser uma imagem',
            'numero_portas.integer' => 'O numero de portas deve ser um numero inteiro',
            'numero_portas.digits_between' => 'O numero de portas deve estar entre 1 e 5',
            'lugares.digits_between' => 'O numero de lugares deve estar entre 1 e 57',
            'lugares.integer' => 'O numero de lugares deve ser um numero inteiro',
            'air_bag.boolean' => 'Campo deve conter TRUE ou FALSE',
            'abs.boolean' => 'Campo deve conter TRUE ou FALSE'
        ];
    }
}
