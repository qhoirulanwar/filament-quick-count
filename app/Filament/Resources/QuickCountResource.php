<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuickCountResource\Pages;
use App\Filament\Resources\QuickCountResource\RelationManagers;
use App\Models\District;
use App\Models\Province;
use App\Models\QuickCount;
use App\Models\Regency;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class QuickCountResource extends Resource
{
    protected static ?string $model = QuickCount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $kecamatan = 'ok';
        $collection = Collection::times(56, function ($number) {
            $key = ($number - 1);
            $value = ($number - 1);
            return [$key => $value];
        })->collapse();

        function FunctionName(): void
        {
            global $kecamatan;
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($kecamatan);
        }

        return $form
            ->schema([
                Forms\Components\Select::make('province_id')
                    ->label('Provinsi')
                    ->default(36)
                    ->required()
                    ->searchable()
                    ->relationship('province', 'name'),
                // Forms\Components\TextInput::make('province_id')->default(36)->hidden(true),
                Forms\Components\Select::make('regency_id')
                    ->label('kab/kota')
                    ->required()
                    // ->searchable()
                    ->options(fn (Get $get): Collection => Regency::query()
                        ->where('province_id', 36)
                        ->pluck('name', 'id')),
                // ->relationship('district', 'name'),
                Forms\Components\Select::make('district_id')
                    ->label('Kecamatan')
                    ->required()
                    ->searchable()

                    ->options(fn (Get $get): Collection => District::query()
                        ->where('regency_id', $get('regency_id'))
                        ->pluck('name', 'id')),
                // ->relationship('regency', 'name'),
                // ->afterStateUpdated(function ($state) {
                //     if (blank($state)) return;

                //     global $kecamatan;

                //     $kecamatan = $state;

                //     $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                //     $out->writeln($kecamatan);
                // }),
                Forms\Components\Select::make('village_id')
                    ->label('kelurahan')
                    ->required()
                    ->searchable()
                    ->options(fn (Get $get): Collection => Village::query()
                        ->where('district_id', $get('district_id'))
                        ->pluck('name', 'id')),
                // ->relationship('village', 'name')
                // ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name} - {$record->district->name}"),
                Forms\Components\Select::make('caleg_id')
                    ->required()
                    ->relationship('caleg', 'name'),
                Forms\Components\select::make('tps')
                    ->options($collection)
                    ->placeholder('Pilih No. TPS')
                    ->required(),
                Forms\Components\TextInput::make('vote')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('province.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('regency.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('district.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('village.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('caleg.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tps')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vote')
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
                // Tables\Filters\SelectFilter::make('province.name'),
                // Tables\Filters\SelectFilter::make('regency.name'),
                // Tables\Filters\SelectFilter::make('district.name'),
                // Tables\Filters\SelectFilter::make('caleg.name'),
                // ->default(1)
                SelectFilter::make('province_id')
                    ->default('36')
                    ->options(fn (Get $get): Collection => Province::query()
                        ->find(36)
                        ->pluck('name', 'id')),
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
            'index' => Pages\ListQuickCounts::route('/'),
            'create' => Pages\CreateQuickCount::route('/create'),
            'edit' => Pages\EditQuickCount::route('/{record}/edit'),
        ];
    }
}
