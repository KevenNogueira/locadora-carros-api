<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarcaRequest extends FormRequest
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
            'cnpj' => 'required|min:14|max:14|unique:marcas,cnpj',
            'nome' => 'required|min:3|max:30',
            'e-mail' => 'required|email|min:1|max:100',
            'imagem' => 'required|image|max:10'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'cnpj.unique' => 'O CNPJ já foi cadastrado',
            'cnpj.min' => 'O CNPJ deve conter no minimo 14 caracteres',
            'cnpj.max' => 'O CNPJ deve conter no máximo 14 caracteres',
            'nome.min' => 'O nome deve conter no minimo 3 caracteres',
            'nome.max' => 'O nome deve conter no máximo 30 caracteres',
            'e-mail.email' => 'O campo e-mail deve ser um e-mail',
            'e-mail.min' => 'O e-mail deve conter no minimo 3 caracteres',
            'e-mail.max' => 'O e-mail deve conter no máximo 100 caracteres',
            'imagem.max' => 'A imagem deve conter no máximo 100kb',
            'imagem.image' => 'O arquivo deve ser uma imagem'
        ];
    }
}