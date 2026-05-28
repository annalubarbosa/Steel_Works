<?php

namespace App\Filament\Resources\MovimentoResource\Pages;

use App\Filament\Resources\MovimentoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Produto;
use Filament\Notifications\Notification;
class CreateMovimento extends CreateRecord
{
    protected static string $resource = MovimentoResource::class;

    //antes de criar 
    protected function beforeCreate(): void
    {
        $data=$this->data;
        $produto = Produto::find($data['id_produto']);
        $quantidade = (int)$data['quantidade'];
        $tipo = $data['tipo_movimentacao'];

        if (!$produto) {
            Notification::make()
                ->title('Produto não encontrado')
                ->body('Selecione um produto válido.')
                ->danger()
                ->send();
            
            $this->halt();
        }
        if ($tipo === 'saida' && $quantidade >$produto->quantidade){
            Notification::make() //make: cria notificação que vai aparecer em vermelho no topo
                ->title('Estoque insuficiente')
                ->body("Estoque de '{$produto->nome}' é de apenas {$produto->quantidade} unidades")
                ->danger()
                ->send();//envia a notificação para o usuário no painel admin
            $this->halt(); //execute imediatamente
        }
    }
    //depois de criar 
    protected function afterCreate(): void
    {
        $movimento = $this->getRecord();
        $produto = $movimento->produto;

        if ( $movimento->tipo_movimentacao === 'entrada'){
            $produto->increment('quantidade', $movimento->quantidade);
        } else {
            $produto->decrement('quantidade', $movimento->quantidade);
        }
    }
}