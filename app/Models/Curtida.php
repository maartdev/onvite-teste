<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curtida extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'sugestao_id',
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function sugestao() {
        return $this->belongsTo(Sugestao::class);
    }
}
