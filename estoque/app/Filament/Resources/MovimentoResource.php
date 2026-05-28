<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimentoResource\Pages;
use App\Filament\Resources\MovimentoResource\RelationManagers;
use App\Models\Movimento;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimentoResource extends Resource
{
    protected static ?string $model = Movimento::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id_produto')
                    ->required()
                    ->numeric(),
                TextInput::make('quantidade')
                    ->required()
                    ->numeric(),

                Select::make('tipo_movimentacao')
                    ->label('Tipo de Movimentação')
                    ->options([
                        'entrada' => 'Entrada',
                        'saida' => 'Saída',
                    ])
                    ->required(),

                DatePicker::make('data_movimentacao')
                    ->label('Data de Movimentação')
                    ->required()
                    
                
        
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id_produto')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipo_movimentacao')
                    ->label('Tipo de Movimentação')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'entrada' => 'success',
                        'saida'  => 'info',   }),

                TextColumn::make('quantidade')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
          
            
            ])
            ->filters([
        
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMovimentos::route('/'),
            'create' => Pages\CreateMovimento::route('/create'),
            'edit' => Pages\EditMovimento::route('/{record}/edit'),
        ];
    }
}
