<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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

        return response()->json(
            [
                'marcas' => $marcas,
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarcaRequest $request)
    {
        $logo = $request->file('imagem');

        $pathLogo = $logo->store('imagens/logo', 'public');

        $marca = $this->marca->create([
            'cnpj' => $request->cnpj,
            'nome' => $request->nome,
            'email' => $request->email,
            'imagem' => $pathLogo,
        ]);

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
    public function show($cnpj)
    {
        $marca = $this->marca->find($cnpj);

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
                'mensagem' => 'Marca Localizada',
                'obj' => $marca,
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcaRequest $request, $cnpj)
    {
        $marca = $this->marca->find($cnpj);

        if (empty($marca)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas a marca procurada e impossivel de ser atualizada, pois não existe!'
                ],
                404
            );
        }

        $pathLogo = null;
        $logo = $request->file('imagem');


        if ($logo != null) {
            $pathLogo = $logo->store('imagens/logo', 'public');
            Storage::disk('public')->delete($marca->imagem);
        }

        $cnpj = $request->cnpj == null ? $marca->cnpj : $request->cnpj;
        $nome = $request->nome == null ? $marca->nome : $request->nome;
        $email = $request->email == null ? $marca->email : $request->email;
        $imagem = $pathLogo == null ? $marca->imagem : $pathLogo;


        $marca->update(
            [
                'cnpj' => $cnpj,
                'nome' => $nome,
                'email' => $email,
                'imagem' => $imagem
            ]
        );

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
    public function destroy($cnpj)
    {
        $marca = $this->marca->find($cnpj);

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

        Storage::disk('public')->delete($marca->imagem);
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
