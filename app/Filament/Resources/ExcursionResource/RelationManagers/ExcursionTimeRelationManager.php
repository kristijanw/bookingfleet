<?php

namespace App\Filament\Resources\ExcursionResource\RelationManagers;

use App\Models\ExcursionTime;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;

class ExcursionTimeRelationManager extends RelationManager
{
    protected static string $relationship = 'excursionTime';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->format('c')
                    ->required(),

                Forms\Components\TextInput::make('capacity')
                    ->required()
                    ->numeric(),

                Forms\Components\Repeater::make('start_time')
                    ->simple(
                        Forms\Components\TimePicker::make('name')
                            ->native(true)
                            ->seconds(false)
                            ->required(),
                    )
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('date')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->formatStateUsing(fn(string $state) => Carbon::parse($state)->format('d.m.Y')),

                Tables\Columns\TextColumn::make('start_time')
                    ->badge(),

                Tables\Columns\TextColumn::make('capacity'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('date_filter')
                    ->options([
                        '01' => '1 month',
                        '02' => '2 months',
                        '03' => '3 months',
                        '04' => '4 months',
                        '05' => '5 months',
                        '06' => '6 months',
                        '07' => '7 months',
                        '08' => '8 months',
                        '09' => '9 months',
                        '10' => '10 months',
                        '11' => '11 months',
                        '12' => '12 months',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn(Builder $query, $date): Builder => $query->whereMonth('date', $date),
                        );
                    }),

            ])
            ->headerActions([
                CreateAction::make('copyquestions')
                    ->label('Add end date')
                    ->color('warning')
                    ->hidden(fn(RelationManager $livewire) => $livewire->getOwnerRecord()->excursionTime->count() == 0)
                    ->form([
                        Forms\Components\DatePicker::make('end_date')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->required(),
                    ])
                    ->createAnother(false)
                    ->mutateFormDataUsing(function (array $data): array {
                        $findExcursionTime = ExcursionTime::with('excursion')->orderBy('created_at', 'desc')->first();
                        $period = CarbonPeriod::between(
                            Carbon::parse($findExcursionTime->date)->addDay(),
                            Carbon::parse($data['end_date'])
                        );

                        foreach ($period as $date) {
                            $excursionTime = new ExcursionTime;
                            $excursionTime->date = $date->format('c');
                            $excursionTime->start_time = $findExcursionTime->start_time;
                            $excursionTime->capacity = $findExcursionTime->capacity;
                            $excursionTime->excursion_id = $findExcursionTime->excursion->id;
                            $excursionTime->save();
                        }

                        return $data;
                    })
                    ->after(function () {
                        ExcursionTime::where('date', null)->delete();
                    }),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
