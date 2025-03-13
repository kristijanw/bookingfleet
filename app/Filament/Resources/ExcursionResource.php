<?php

namespace App\Filament\Resources;

use App\Enums\ExcursionStatus;
use App\Filament\Resources\ExcursionResource\Pages;
use App\Filament\Resources\ExcursionResource\RelationManagers\ExcursionTimeRelationManager;
use App\Models\Excursion;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExcursionResource extends Resource
{
    protected static ?string $model = Excursion::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([

                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->prefix('EUR'),

                    Forms\Components\TextInput::make('google_maps_url'),

                    Forms\Components\TextInput::make('boat_capacity')
                        ->required()
                        ->numeric(),

                    Forms\Components\Radio::make('skipper')
                        ->label('Skipper')
                        ->options([
                            'yes' => 'Yes',
                            'no' => 'No',
                        ])
                        ->default('no')
                        ->inline()
                        ->inlineLabel(false),

                    Forms\Components\Repeater::make('included_in_price')
                        ->simple(
                            Forms\Components\TextInput::make('name')->required(),
                        )
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('gallery')
                        ->required()
                        ->multiple()
                        ->disk('public')
                        ->directory('excursion')
                        ->panelLayout('grid')
                        ->maxFiles(10)
                        ->columnSpanFull(),

                ])->columns(2)->columnSpan(2),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\Select::make('category_id')
                                ->label('Category')
                                ->required()
                                ->native(false)
                                ->relationship('category', 'title', function (Builder $query) {
                                    return $query;
                                }),
                        ]),

                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\ToggleButtons::make('status')
                                ->inline()
                                ->options(ExcursionStatus::class)
                                ->required(),
                        ]),

                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\Select::make('category_id')
                                ->relationship('category', 'title')
                                ->columnSpanFull(),

                            Forms\Components\Placeholder::make('created_at')
                                ->label('Created at')
                                ->content(fn(Excursion $record): ?string => $record->created_at?->diffForHumans()),

                            Forms\Components\Placeholder::make('updated_at')
                                ->label('Last modified at')
                                ->content(fn(Excursion $record): ?string => $record->updated_at?->diffForHumans()),
                        ])->columns(2)->hidden(fn(?Excursion $record) => $record === null),

                    Forms\Components\Section::make()
                        ->schema([
                            Forms\Components\FileUpload::make('header_img')
                                ->image()
                                ->disk('public')
                                ->directory('excursion')
                                ->required(),
                        ]),
                ])->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('EUR'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('category.title')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable(),
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
            ExcursionTimeRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExcursions::route('/'),
            'create' => Pages\CreateExcursion::route('/create'),
            'edit' => Pages\EditExcursion::route('/{record}/edit'),
        ];
    }
}
