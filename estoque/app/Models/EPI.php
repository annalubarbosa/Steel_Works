<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EPI extends Model
{
    protected $fillable = [
        'id_produto', 'numero_ca', 'data_validade'
    ];

    protected $casts = [
        'data_validade' => 'date'    
    ];

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto' );
    }
}
