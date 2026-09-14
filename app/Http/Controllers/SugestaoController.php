<?php

namespace App\Http\Controllers;

use App\Models\Sugestao;
use Illuminate\Http\Request;

class SugestaoController extends Controller
{
    public function criar(Request $request)
    {
        $dados = $request->validate([
            'pedido_id' => 'required|integer|exists:pedidos,id',
            'valor_pedido' => 'required|numeric',
        ]);

        $sugestao = Sugestao::criarComCreditos($dados['pedido_id'], $dados['valor_pedido']);

        return response()->json($sugestao, 201);
    }

    public function listarPendentes()
    {
        $sugestoes = Sugestao::where('status', 'pendente')->get();
        return response()->json($sugestoes);
    }

    public function aprovar(Request $request, int $id)
    {
        // aprova
    }
}
