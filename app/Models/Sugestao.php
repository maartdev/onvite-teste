<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    protected $table = 'sugestoes';
    protected $fillable = [
        'pedido_id',
        'creditos',
        'status',
        'meta',
        'preco',
        'prazo',
    ];
    protected $casts = [
        'creditos' => 'decimal:2',
        'preco' => 'decimal:2',
        'prazo' => 'datetime', 
    ];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }

    public static function criarComCreditos(int $pedidoId, float $valorPedido): self {
        return self::create([
            'pedido_id' => $pedidoId,
            'creditos' => $valorPedido * 5,
            'status' => 'pendente',
        ]);
    }
}
