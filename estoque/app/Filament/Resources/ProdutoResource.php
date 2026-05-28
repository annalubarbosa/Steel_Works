<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoResource\Pages;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
        TextInput::make('nome')
            ->label('Nome')
            ->required(),
        
        TextInput::make('preco')
            ->label('Preço')
            ->numeric()
            ->required(),

        TextInput::make('quantidade')
            ->label('Quantidade')
            ->numeric()
            ->required(),

      

        Select::make('categoria')
            ->label('Categoria')
            ->options([
                'liga' => 'Liga Metálica',
                'epi' => 'EPIs',
            ])
            ->required(),

        TextInput::make('fornecedor')
            ->label('Fornecedor')
            ->required(),



        TextInput::make('estoque_minimo')
            ->label('Estoque mínimo')
            ->numeric()
            ->required(),
            ]);

        

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
            Tables\Columns\TextColumn::make('nome')
            ->label('Nome')
            ->sortable()
            ->searchable(),

        Tables\Columns\TextColumn::make('preco')
            ->label('Preço')
            ->money('BRL')
            ->sortable(),

        Tables\Columns\TextColumn::make('quantidade')
            ->label('Quantidade')
            ->sortable(),

        Tables\Columns\TextColumn::make('estoque_minimo')
            ->label('Estoque Mínimo')
            ->sortable(),

        Tables\Columns\TextColumn::make('categoria')
            ->label('Categoria')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'liga' => 'success',
                'epi'  => 'info',
            })
            ->sortable(),

        Tables\Columns\TextColumn::make('created_at')
            ->label('Criado em')
            ->dateTime('d/m/Y H:i')
            ->sortable()
            ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria')
                ->options([
                    'liga' => 'Liga Metálica',
                    'epi'  => 'EPIs',
                ])
                ->label('Categoria'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
