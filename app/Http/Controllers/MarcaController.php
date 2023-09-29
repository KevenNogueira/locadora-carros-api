<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;

class MarcaController extends Controller
{
    public $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = $this->marca->all();

        return response()->json($marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarcaRequest $request)
    {
        $request->validated();

        $marca = $this->marca->create($request->all());
        return response()->json(
            [
                'statusCode' => 201,
                'mensagem' => 'Criação feita com sucesso!',
                'obj' => $marca,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);

        if (empty($marca)) {
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
                'mensagem' => 'Entidade encontrada',
                'obj' => $marca,
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcaRequest $request, $id)
    {

        $httpMethod = $request->method();

        //dd($httpMethod);

        $request->add(['http_method' => $httpMethod]);

        $request->validated();

        $marca = $this->marca->find($id);

        if (empty($marca)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o item procurado e impossivel de ser atualizado, pois não existe!'
                ],
                404
            );
        }

        $marca->update($request->all());

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Atualização bem-sucedida.',
                'obj' => $marca
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $marca = $this->marca->find($id);

        if (empty($marca)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o item procurado não existe!'
                ],
                404
            );
        }

        $marca->delete();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Marca excluida com sucesso!'
            ],
            200
        );
    }
}
