<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Marca;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;
use App\Repositories\MarcaRepository;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {

        $marcaRepository = new MarcaRepository($this->marca);

        if ($request->has('attr_modelos')) {
            $attr_modelos = 'modelos:num_modelo,' . $request->get('attr_modelos');
            $marcaRepository->selecaoAttrsRelacionado($attr_modelos);
        } else {
            $marcaRepository->selecaoAttrsRelacionado('modelos');
        }

        if ($request->has('filtro')) {
            $marcaRepository->filtro($request->get('filtro'));
        }

        if ($request->has('attr')) {
            $marcaRepository->selecaoAttrs($request->get('attr'));
        }

        return response()->json(
            [
                'marcas' => $marcaRepository->getResultado(),
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
                'marca' => $marca,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($cnpj)
    {
        $marca = $this->marca->with('modelos')->find($cnpj);

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
                'marca' => $marca,
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

        $pathLogo = $marca->imagem;
        $logo = $request->file('imagem');


        if ($logo != null) {
            $pathLogo = $logo->store('imagens/logo', 'public');
            Storage::disk('public')->delete($marca->imagem);
        }

        $marca->fill($request->all());
        $marca->imagem = $pathLogo;
        $marca->save();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Atualização bem-sucedida.',
                'marca' => $marca
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
