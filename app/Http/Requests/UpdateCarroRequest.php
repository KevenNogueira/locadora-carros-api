<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarroRequest extends FormRequest
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
            'vin' => 'required|min:17|max:17|unique:carros,vin',
            'num_modelo' => 'required|min:6|max:6|exists:modelos,num_modelo',
            'placa' => 'required|min:10|max:10|unique:carros,placa',
            'disponivel' => 'required|boolean',
            'km' => 'required|integer',
        ];

        if ($httpMethod === 'PATCH') {
            $rules = [
                'vin' => 'sometimes|required|min:17|max:17|unique:carros,vin',
                'num_modelo' => 'sometimes|required|min:6|max:6|exists:modelos,num_modelo',
                'placa' => 'sometimes|required|min:10|max:10|unique:carros,placa',
                'disponivel' => 'sometimes|required|boolean',
                'km' => 'sometimes|required|integer',
            ];

            return $rules;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'vin.min' => 'O VIN deve conter no minimo 17 caracteres',
            'vin.max' => 'O VIN deve conter no máximo 17 caracteres',
            'num_modelo.exists' => 'O número do modelo informado não existe no banco de dados',
            'num_modelo.min' => 'O número do modelo deve conter no minimo 6 caracteres',
            'num_modelo.max' => 'O número do modelo deve conter no máximo 6 caracteres',
            'placa.unique' => 'A placa informada já existe!',
            'placa.min' => 'A placa do veiculo deve conter no minimo 10 caracteres',
            'placa.max' => 'A placa do veiculo deve conter no máximo 10 caracteres',
            'disponivel.boolean' => 'Campo deve conter TRUE(1) ou FALSE(0)',
            'km.integer' => 'O numero de KM deve ser um numero inteiro',
        ];
    }
}