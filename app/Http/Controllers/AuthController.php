<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all(['email', 'password']);

        // autenticação email e senha
        $token = auth('api')->attempt($credenciais);

        if (empty($token)) {
            return response()->json(
                [
                    'statusCode' => 403,
                    'erro' => 'Usuário ou senha inválido!'
                ],
                403
            );
        }

        return response()->json(
            [
                'statusCode' => 200,
                'token' => $token
            ],
            200
        );
    }

    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {

        //diz para o intelephense ignorar a variável authGuard que receberá o método refresh()
        /** @var \Tymon\JWTAuth\JWTGuard $authGuard */

        $authGuard = auth('api');

        $token = $authGuard->refresh();

        return response()->json(
            [
                'statusCode' => 200,
                'mensagem' => 'Token renovado com sucesso!!',
                'token' => $token
            ],
            200
        );
    }

    public function me()
    {
        return response()->json(
            [
                'statusCode' => 200,
                'usuário' => auth()->user(),
            ],
            200
        );
    }
}
