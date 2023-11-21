<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Http\Requests\StoreLocacaoRequest;
use App\Http\Requests\UpdateLocacaoRequest;
use App\Repositories\LocacaoRepository;
use Illuminate\Http\Request;

class LocacaoController extends Controller
{

    public $locacao;

    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        if ($request->has('filtro')) {
            $locacaoRepository->filtro($request->get('filtro'));
        }

        if ($request->has('attr')) {
            $locacaoRepository->selecaoAttrs($request->get('attr'));
        }

        return response()->json(
            [
                'Locações' => $locacaoRepository->getResultado(),
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocacaoRequest $request)
    {
        $locacao = $this->locacao->create([
            'cpf_cliente' => $request->cpf_cliente,
            'vin_carro' => $request->vin_carro,
            'data_inicio_periodo' => $request->data_inicio_periodo,
            'data_final_previsto_periodo' => $request->data_final_previsto_periodo,
            'data_final_realizado_periodo' => $request->data_final_realizado_periodo,
            'valor_diaria' => $request->valor_diaria,
            'km_inicial' => $request->km_inicial,
            'km_final' => $request->km_final,
        ]);

        return response()->json(
            [
                'statusCode' => 201,
                'mensagem' => 'Criação feita com sucesso!',
                'Locação' => $locacao,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $locacao = $this->locacao->find($id);

        if (empty($locacao)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas a Locação procurada e impossivel de ser localizada, pois não existe!',
                ],
                404
            );
        }

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Locação localizada',
                'Locação' => $locacao,
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocacaoRequest $request, $id)
    {
        $locacao = $this->locacao->find($id);

        if (empty($locacao)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas a locação procurada e impossivel de ser atualizada, pois não existe!'
                ],
                404
            );
        }

        $locacao->fill($request->all());
        $locacao->save();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Atualização bem-sucedida.',
                'Locação' => $locacao
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $locacao = $this->locacao->find($id);

        if (empty($locacao)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas a locação procurada não existe!'
                ],
                404
            );
        }

        $locacao->delete();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Locação excluido com sucesso!'
            ],
            200
        );
    }
}