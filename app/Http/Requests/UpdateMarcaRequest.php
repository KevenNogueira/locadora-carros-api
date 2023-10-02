<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarcaRequest extends FormRequest
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

        $httpMethod = $this->header('X-HTTP-Method');

        $rules = [
            'cnpj' => 'required|min:14|max:14',
            'nome' => 'required|min:3|max:30',
            'email' => 'required|email|min:3|max:100',
            'imagem' => 'required|min:1|max:100'
        ];

        if ($httpMethod === 'PATCH') {

            $rules = [
                'cnpj' => 'sometimes|required|min:14|max:14',
                'nome' => 'sometimes|required|min:3|max:30',
                'email' => 'sometimes|required|email|min:3|max:100',
                'imagem' => 'sometimes|required|min:1|max:100'
            ];

            return $rules;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'cnpj.min' => 'O CNPJ deve conter no minimo 14 caracteres',
            'cnpj.max' => 'O CNPJ deve conter no máximo 14 caracteres',
            'nome.min' => 'O nome deve conter no minimo 3 caracteres',
            'nome.max' => 'O nome deve conter no máximo 30 caracteres',
            'email.email' => 'O campo email deve ser um email',
            'email.min' => 'O email deve conter no minimo 3 caracteres',
            'email.max' => 'O email deve conter no máximo 100 caracteres',
            'imagem.min' => 'A imagem deve conter no minimo 1 caracter',
            'imagem.max' => 'A imagem deve conter no máximo 100kb'
        ];
    }
}
