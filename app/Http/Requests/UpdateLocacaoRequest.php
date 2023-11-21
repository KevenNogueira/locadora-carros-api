<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocacaoRequest extends FormRequest
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
            'cpf_cliente' => 'required|min:11|max:11|exists:clientes,cpf',
            'vin_carro' => 'required|min:17|max:17|exists:carros,vin',
            'data_inicio_periodo' => 'required|date',
            'data_final_previsto_periodo' => 'required|date',
            'data_final_realizado_periodo' => 'sometimes|required|date',
            'valor_diaria' => 'required|decimal:2',
            'km_inicial' => 'required|integer',
            'km_final', 'sometimes|required|integer',
        ];

        if ($httpMethod === 'PATCH') {

            $rules = [
                'cpf_cliente' => 'sometimes|required|min:11|max:11|exists:clientes,cpf',
                'vin_carro' => 'sometimes|required|min:17|max:17|exists:carros,vin',
                'data_inicio_periodo' => 'sometimes|required|date',
                'data_final_previsto_periodo' => 'sometimes|required|date',
                'data_final_realizado_periodo' => 'sometimes|required|date',
                'valor_diaria' => 'sometimes|required|decimal:2',
                'km_inicial' => 'sometimes|required|integer',
                'km_final', 'sometimes|required|integer',
            ];

            return $rules;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'date' => 'O campo :attribute deve ser uma data',
            'integer' => 'O campo:attribute deve ser um número inteiro',
            'cpf.exists' => 'O CPF informado não existe em nossa base de cliente! Favor cadastra-lo',
            'cpf.min' => 'O CPF deve conter no minimo 11 caracteres',
            'cpf.max' => 'O CPF deve conter no máximo 11 caracteres',
            'vin.exists' => 'O VIN informado, não existe em nossa base de Carros! Favor cadastra-lo',
            'vin.min' => 'O VIN deve conter no minimo 17 caracteres',
            'vin.max' => 'O VIN deve conter no máximo 17 caracteres',
            'valor_diaria' => 'o valor deve ser cadastrado com 2 casas decimais! Exemplo: 9.99',
        ];
    }
}