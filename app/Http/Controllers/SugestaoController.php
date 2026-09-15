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
        $sugestao = Sugestao::findOrFail($id);

        if ($sugestao->status != 'pendente') 
        {
            return response()->json('Conflito', 409);
        }

        $dados = $request->validate([
        'meta' => 'required|integer',
        'preco' => 'required|numeric',
        ]);

        $sugestao->meta = $dados['meta'];
        $sugestao->preco = $dados['preco'];
        $sugestao->status = 'aprovado';
        $sugestao->prazo = now()->addDays(30);
        $sugestao->save();

        return response()->json('Atualizado com sucesso', 200);
    }
}

