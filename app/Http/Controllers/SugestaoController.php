<?php

namespace App\Http\Controllers;

use App\Models\Sugestao;
use App\Models\Curtida;

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

    public function aprovar(Request $request, int $id)
    {
        $sugestao = Sugestao::findOrFail($id);

        if ($sugestao->status != 'pendente') 
        {
            return response()->json(['erro' => 'Sugestão já foi avaliada'], 409);
        }

            $dados = $request->validate([
            'meta' => 'required|integer',
            'preco' => 'required|numeric',
            ]);

            $sugestao->meta = $dados['meta'];
            $sugestao->preco = $dados['preco'];
            $sugestao->status = 'aprovada';
            $sugestao->prazo = now()->addDays(30);
            $sugestao->data_publicacao = now();
            $sugestao->save();

            return response()->json($sugestao, 200);
    }

    public function negar(int $id) {
        $sugestao = Sugestao::findOrFail($id);

        if ($sugestao->status != 'pendente') {
            return response()->json(["erro" => "Sugestão já foi avaliada"], 409);
        }

        $sugestao->status = 'negada';
        $sugestao->save();

        return response()->json($sugestao, 200);
    }

    public function listarSugestoes(string $status) {
        $sugestoes = Sugestao::where('status', $status)->get();

        return response()->json($sugestoes, 200);

    }

    public function curtida(Request $request, int $id) {
        $sugestao = Sugestao::findOrFail($id);
        $sugestaoId = $sugestao->id;

        $dados = $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,id',
        ]);
        $clienteId = $dados['cliente_id'];

        $curtida = Curtida::where('cliente_id', $clienteId)->where('sugestao_id', $sugestaoId)->first();

        if ($curtida != null) {
            $curtida->delete();

            return response()->json(['mensagem' => 'sugestão descurtida'], 200);

        } else 
        {
            Curtida::create([
                'cliente_id' => $clienteId,
                'sugestao_id' => $sugestaoId,
            ]);

            return response()->json(['mensagem' => 'sugestão curtida'], 200);
        }
    }

    public function ranking() {
        $sugestoes = Sugestao::where('status', 'aprovada')->withCount('curtidas')->orderBy('curtidas_count', 'desc')->get();

        return response()->json($sugestoes, 200);
    }
}
