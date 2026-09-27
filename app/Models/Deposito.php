<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'sugestao_id',
        'valor',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function sugestao() {
        return $this->belongsTo(Sugestao::class);
    }
}
