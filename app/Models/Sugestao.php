<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected $appends = [
        'apoiantes_total',
    ];

    protected $casts = [
        'creditos' => 'decimal:2',
        'preco' => 'decimal:2',
        'prazo' => 'datetime',
        'data_publicacao' => 'datetime',
        'liberada_em' => 'datetime',
    ];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }

    public function curtidas() {
        return $this->hasMany(Curtida::class);
    }

    public function depositos(){
        return $this->hasMany(Deposito::class);
    }

    public function apoiantes(): int {
        return $this->depositos()->distinct()->count('cliente_id');
    }

    public function metaAtingida(): bool{
        if ($this->meta === null){
            return false;
        }

        return $this->apoiantes() >= $this->meta;
    }

    public function liberarMeta(): bool{
        if ($this->liberada_em === null && $this->metaAtingida()){
            $this->liberada_em = now();
            $this->save();
        }

        return $this->liberada_em !== null;
    }

    public static function criarComCreditos(int $pedidoId, float $valorPedido): self {
        return self::create([
            'pedido_id' => $pedidoId,
            'creditos' => $valorPedido * 5,
            'status' => 'pendente',
        ]);
    }
    
    protected function apoiantesTotal(): Attribute {
        return Attribute::make(
            get: fn () => $this->apoiantes(),
        );
    }

}
