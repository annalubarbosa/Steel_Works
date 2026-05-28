<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;


class EPI extends Model
{
    protected $table = 'e_p_i_s';
    protected $fillable = [
        'id_produto', 'numero_ca', 'data_validade'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto' );
    }
}
