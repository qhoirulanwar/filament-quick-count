<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalegResource\Pages;
use App\Filament\Resources\CalegResource\RelationManagers;
use App\Http\Controllers\ReportController;
use App\Models\Caleg;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalegResource extends Resource
{
    protected static ?string $model = Caleg::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('caleg_type_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('caleg_type_id')
                    ->relationship('calegType', 'name')
                    ->required()
                    ->preload()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('calegType.name')
                    // ->numeric()
                    ->label('DAPIL')
                    ->sortable(),
                TextColumn::make('Total Suara')
                    ->getStateUsing(function (Model $record) {
                        $reportController = new ReportController();
                        return $reportController->show($record);
                    }),
                // ViewColumn::make('view')
                //     ->view('tables.columns.vote-total-caleg'),
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
            'index' => Pages\ListCalegs::route('/'),
            'create' => Pages\CreateCaleg::route('/create'),
            'edit' => Pages\EditCaleg::route('/{record}/edit'),
        ];
    }
}
