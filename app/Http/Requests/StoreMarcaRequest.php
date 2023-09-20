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
            'e-mail' => 'required|email|max:100',
            'imagem' => 'required|max:100'
        ];
    }
}
