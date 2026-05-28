<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Movimento;


class Produto extends Model
{
    protected $fillable = [
        'id_produto', 'nome', 'preco', 'quantidade', 'categoria', 'fornecedor', 'estoque_minimo'
    ];

    public function movimentos()
    {
        return $this->hasMany(Movimento::class);
    }
}
