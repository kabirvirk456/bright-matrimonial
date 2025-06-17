<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Questions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('text')
                    ->label('Question')
                    ->required(),
                Select::make('gender')
    ->options([
        'male'   => 'Male',
        'female' => 'Female',
        'other'  => 'Other',
        'general' => 'General', // Optional, if you use general
    ])
    ->label('Gender')
    ->required(),

                TextInput::make('order')
                    ->numeric()
                    ->label('Order')
                    ->nullable(),
                Repeater::make('options')
                    ->label('Options')
                    ->schema([
                        TextInput::make('option')
                            ->label('Option')
                            ->required(),
                    ])
                    ->minItems(2)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->toggleable(),
                TextColumn::make('text')->label('Question')->limit(50)->searchable()->toggleable(),
                BadgeColumn::make('gender')->colors([
                    'primary' => 'man',
                    'pink'    => 'woman',
                ])->toggleable(),
                TextColumn::make('order')->sortable()->toggleable(),
                TextColumn::make('options')
                    ->label('Options')
                    ->formatStateUsing(function ($state) {
                        // Shows options as a comma-separated string in the table
                        return is_array($state)
                            ? implode(', ', array_map(function($opt) {
                                return is_array($opt) && isset($opt['option']) ? $opt['option'] : $opt;
                            }, $state))
                            : '';
                    })
                    ->toggleable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('gender')
                    ->options([
                        'man' => 'Man',
                        'woman' => 'Woman',
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
