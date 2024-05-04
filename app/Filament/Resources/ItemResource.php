<?php

namespace App\Filament\Resources;

use App\Enums\ItemStatus;
use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->autofocus()
                            ->columnSpanFull(),

                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name'),

                        Forms\Components\TextInput::make('qty')
                            ->label('Quantity')
                            ->required()
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\ToggleButtons::make('condition')
                            ->required()
                            ->inline()
                            ->options(ItemStatus::class),

                        Forms\Components\TextInput::make('location')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(['lg' => 2]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('qty')
                    ->label('Quantity')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('condition')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
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
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
