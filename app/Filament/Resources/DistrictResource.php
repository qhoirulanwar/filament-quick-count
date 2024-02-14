<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DistrictResource\Pages;
use App\Filament\Resources\DistrictResource\RelationManagers;
use App\Http\Controllers\ReportController;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

class DistrictResource extends Resource
{
    protected static ?string $model = District::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canViewAny(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('regency_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('regency_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
                SelectFilter::make('regency_id')
                    ->default('3672')
                    ->options(fn (Get $get): Collection => Regency::query()
                        ->find(3672)
                        ->pluck('name', 'id')),
            ])
            ->actions([
                Action::make('advance')
                    // ->action(fn (Post $record) => $record->advance())
                    // ->modalContent(view('filament.modals.report', ['record' => 'ecord']))
                    // ->modalContent(fn (District $record): View => view(
                    //     'filament.modals.report',
                    //     ['record' => $record],
                    // ))
                    ->modalContent(function (District $record): View {
                        // return view(
                        //     'filament.modals.report',
                        //     ['record' => $record]
                        // );
                        $reportController = new ReportController();
                        return $reportController->show($record);
                    })
                    ->modalWidth(MaxWidth::Screen)
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                // Tables\Actions\EditAction::make(),
                // Action::make('sendEmail')
                // ->form([
                //     TextInput::make('subject')->required(),
                //     RichEditor::make('body')->required(),
                // ])
                // ->action(function (array $data) {
                //     // Mail::to($this->client)
                //     //     ->send(new GenericEmail(
                //     //         subject: $data['subject'],
                //     //         body: $data['body'],
                //     //     ));
                // }),
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
            'index' => Pages\ListDistricts::route('/'),
            'create' => Pages\CreateDistrict::route('/create'),
            'edit' => Pages\EditDistrict::route('/{record}/edit'),
        ];
    }
}
