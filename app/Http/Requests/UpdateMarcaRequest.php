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

        //dd($this->input('http_method'));

        $rules = [
            'cnpj' => 'required|min:14|max:14',
            'nome' => 'required|min:3|max:30',
            'e-mail' => 'required|email|min:3|max:100',
            'imagem' => 'required|min:1|max:100'
        ];

        if ($this->input('http_method') === 'PATCH') {

            $rules = [
                'cnpj' => 'sometimes|required|min:14|max:14',
                'nome' => 'sometimes|required|min:3|max:30',
                'e-mail' => 'sometimes|required|email|min:3|max:100',
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
            'e-mail.email' => 'O campo e-mail deve ser um e-mail',
            'e-mail.min' => 'O e-mail deve conter no minimo 3 caracteres',
            'e-mail.max' => 'O e-mail deve conter no máximo 100 caracteres',
            'imagem.min' => 'A imagem deve conter no minimo 1 caracter',
            'imagem.max' => 'A imagem deve conter no máximo 100kb'
        ];
    }
}
