<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Http\Requests\StoreCarroRequest;
use App\Http\Requests\UpdateCarroRequest;
use App\Repositories\CarroRepository;
use Illuminate\Http\Request;

class CarroController extends Controller
{

    public $carro;

    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carroRepository = new CarroRepository($this->carro);

        if ($request->has('attr_modelo')) {
            $attr_modelo = 'modelo:num_modelo,' . $request->get('attr_modelo');
            $carroRepository->selecaoAttrsRelacionado($attr_modelo);
        } else {
            $carroRepository->selecaoAttrsRelacionado('modelo');
        }

        if ($request->has('filtro')) {
            $carroRepository->filtro($request->get('filtro'));
        }

        if ($request->has('attr')) {
            $carroRepository->selecaoAttrs($request->get('attr'));
        }

        return response()->json(
            [
                'carros' => $carroRepository->getResultado(),
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarroRequest $request)
    {

        $carro = $this->carro->create([
            'vin' => $request->vin,
            'num_modelo' => $request->num_modelo,
            'placa' => $request->placa,
            'disponivel' => $request->disponivel,
            'km' => $request->km
        ]);

        return response()->json(
            [
                'statusCode' => 201,
                'mensagem' => 'Criação feita com sucesso!',
                'carro' => $carro,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($vin)
    {
        $carro = $this->carro->with('modelo')->find($vin);

        if (empty($carro)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o item procurado e impossivel de ser localizado, pois não existe!',
                ],
                404
            );
        }

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Carro localizado',
                'carro' => $carro,
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarroRequest $request, $vin)
    {
        $carro = $this->carro->find($vin);

        if (empty($carro)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o carro procurada e impossivel de ser atualizada, pois não existe!'
                ],
                404
            );
        }

        $carro->fill($request->all());
        $carro->save();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Atualização bem-sucedida.',
                'carro' => $carro
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($vin)
    {
        $carro = $this->carro->find($vin);

        if (empty($carro)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o item procurado não existe!'
                ],
                404
            );
        }

        $carro->delete();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Carro excluido com sucesso!'
            ],
            200
        );
    }
}
