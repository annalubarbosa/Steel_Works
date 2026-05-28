<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;


class Movimento extends Model
{
    protected $fillable = [
        'id_produto', 'tipo_movimentacao', 'quantidade', 'data_movimentacao'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto' );
    }
}
