<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Http\Requests\StoreModeloRequest;
use App\Http\Requests\UpdateModeloRequest;
use Illuminate\Support\Facades\Storage;

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
        $modelos = $this->modelo->with('marca')->get();

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
            'nom_modelo' => $request->nom_modelo,
            'imagem' => $pathImgCarro,
            'num_porta' => $request->num_porta,
            'num_assento' => $request->num_assento,
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
    public function show($numModelo)
    {
        $modelo = $this->modelo->with('marca')->find($numModelo);

        if (empty($modelo)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o modelo procurado não existe!',
                ],
                404
            );
        };

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Modelo Localizado!',
                'modelo' => $modelo,
            ],
            404
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModeloRequest $request, $numModelo)
    {
        $modelo = $this->modelo->find($numModelo);

        if (empty($modelo)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mar o modelo procurado e impossivel de ser atualizado, pois não existe!',
                ],
                404
            );
        };

        $pathImgCarro = null;
        $imgCarro = $request->file('imagem');

        if ($imgCarro != null) {
            $pathImgCarro = $imgCarro->store('imagens/carro', 'public');
            Storage::disk('public')->delete($modelo->imagem);
        };

        $numModelo = $request->num_modelo == null ? $modelo->num_modelo : $request->num_modelo;
        $cnpjMarca = $request->cnpj_marca == null ? $modelo->cnpj_marca : $request->cnpj_marca;
        $nomModelo = $request->nom_modelo == null ? $modelo->nom_modelo : $request->nom_modelo;
        $imagem = $request->imagem == null ? $modelo->imagem : $pathImgCarro;
        $numPorta = $request->num_porta == null ? $modelo->num_porta : $request->num_porta;
        $numAssento = $request->num_assento == null ? $modelo->num_assento : $request->num_assento;
        $airBag = $request->air_bag == null ? $modelo->air_bag : $request->air_bag;
        $abs = $request->abs == null ? $modelo->abs : $request->abs;

        $modelo->update(
            [
                'num_modelo' => $numModelo,
                'cnpj_marca' => $cnpjMarca,
                'nom_modelo' => $nomModelo,
                'imagem' => $imagem,
                'num_porta' => $numPorta,
                'num_assento' => $numAssento,
                'air_bag' => $airBag,
                'abs' => $abs,
            ]
        );

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Atualização bem-sucedida.',
                'obj' => $modelo,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($numModelo)
    {
        $modelo = $this->modelo->find($numModelo);

        if (empty($modelo)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Fund',
                    'mensagem' => 'Desculpe! Mas o modelo e impossivel ser excluido, pois o mesmo não existe!',
                ],
                404
            );
        }

        Storage::disk('public')->delete($modelo->imagem);
        $modelo->delete();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Modelo excluido com sucesso!',
            ],
            200
        );
    }
}
