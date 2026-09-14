<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['cliente_id', 'gola', 'cor', 'estampa_img', 'estampa_pos', 'texto', 'qntd', 'observacao'];
}
