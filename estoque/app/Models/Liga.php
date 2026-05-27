<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    protected $fillable = [
        'id_produto', 'tipo_liga', 'ponto_fusao', 'peso'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto' );
    }
}
