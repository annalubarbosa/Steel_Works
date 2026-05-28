<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LigaResource\Pages;
use App\Filament\Resources\LigaResource\RelationManagers;
use App\Models\Liga;
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

class LigaResource extends Resource
{
    protected static ?string $model = Liga::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('id_produto')
                    ->required()
                    ->numeric(),

                TextInput::make('tipo_liga')
                    ->label('Tipo de Liga Métalica')
                    ->string(255)
                    ->required(),
        
                TextInput::make('ponto_fusao')
                    ->label('Ponto de Fusão')
                    ->numeric()
                    ->required(),

                TextInput::make('peso')
                    ->label('Peso (em Toneladas)')
                    ->numeric()
                    ->required(),

      

       

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_produto')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipo_liga')
                    ->label('Tipo de Liga')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ponto_fusao')
                    ->label('Ponto de Fusão em C°')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('peso')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLigas::route('/'),
            'create' => Pages\CreateLiga::route('/create'),
            'edit' => Pages\EditLiga::route('/{record}/edit'),
        ];
    }
}
