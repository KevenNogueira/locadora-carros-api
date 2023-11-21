<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clienteRepository = new ClienteRepository($this->cliente);


        if ($request->has('filtro')) {
            $clienteRepository->filtro($request->get('filtro'));
        }

        if ($request->has('attr')) {
            $clienteRepository->selecaoAttrs($request->get('attr'));
        }

        return response()->json(
            [
                'clientes' => $clienteRepository->getResultado(),
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {

        $cliente = $this->cliente->create([
            'cpf' => $request->cpf,
            'nome' => $request->nome,
            'email' => $request->email,
        ]);

        return response()->json(
            [
                'statusCode' => 201,
                'mensagem' => 'Criação feita com sucesso!',
                'cliente' => $cliente,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($cpf)
    {
        $cliente = $this->cliente->find($cpf);

        if (empty($cliente)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o cliente procurado e impossivel de ser localizado, pois não existe!',
                ],
                404
            );
        }

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Cliente localizado',
                'cliente' => $cliente,
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, $cpf)
    {
        $cliente = $this->cliente->find($cpf);

        if (empty($cliente)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o cliente procurada e impossivel de ser atualizada, pois não existe!'
                ],
                404
            );
        }

        $cliente->fill($request->all());
        $cliente->save();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Atualização bem-sucedida.',
                'cliente' => $cliente
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cpf)
    {
        $cliente = $this->cliente->find($cpf);

        if (empty($cliente)) {
            return response()->json(
                [
                    'statusCode' => 404,
                    'erro' => 'Not Found',
                    'mensagem' => 'Desculpe! Mas o cliente procurado não existe!'
                ],
                404
            );
        }

        $cliente->delete();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Cliente excluido com sucesso!'
            ],
            200
        );
    }
}