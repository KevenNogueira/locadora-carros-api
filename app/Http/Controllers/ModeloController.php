<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Http\Requests\StoreModeloRequest;
use App\Http\Requests\UpdateModeloRequest;

class ModeloController extends Controller
{

    public $modelo;

    public function __construct(Modelo $modelo)
    {

        $this->modelo = $modelo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = $this->modelo->all();

        return response()->json(
            [
                'modelos' => $modelos,
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModeloRequest $request)
    {
        $imgCarro = $request->file('imagem');

        $pathImgCarro = $imgCarro->store('imagens/carro', 'public');

        $modelo = $this->modelo->create([
            'num_modelo' => $request->num_modelo,
            'cnpj_marca' => $request->cnpj_marca,
            'imagem' => $pathImgCarro,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs,
        ]);

        return response()->json(
            [
                'statusCode' => 201,
                'Mensagem' => 'Criação feita com sucesso!',
                'modelo' => $modelo
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModeloRequest $request, Modelo $modelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelo $modelo)
    {
        //
    }
}