<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EPIResource\Pages;
use App\Filament\Resources\EPIResource\RelationManagers;
use App\Models\EPI;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class EPIResource extends Resource
{
    protected static ?string $model = EPI::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_produto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('numero_ca')
                    ->label('Número de Certificado de Aprovação')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('data_validade')
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

                Tables\Columns\TextColumn::make('numero_ca')
                    ->label('Número de Certificado de Aprovação')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_validade')
                    ->label('Data de Validade')
                    ->date()
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
            'index' => Pages\ListEPIS::route('/'),
            'create' => Pages\CreateEPI::route('/create'),
            'edit' => Pages\EditEPI::route('/{record}/edit'),
        ];
    }
}
