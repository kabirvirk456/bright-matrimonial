<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationLabel = 'Profiles';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // User association (if you want to select user)
            Select::make('user_id')
                ->relationship('user', 'email')
                ->searchable()
                ->required(),

            Textarea::make('about')->label('About')->maxLength(500),
            
            // --- Dropdowns now using relationship (not manual options) ---
            Select::make('religion_id')
                ->relationship('religion', 'name')
                ->label('Religion')
                ->searchable()
                ->required(),
            Select::make('caste_id')
                ->relationship('caste', 'name')
                ->label('Caste')
                ->searchable()
                ->required(),
            Select::make('state_id')
                ->relationship('state', 'name')
                ->label('State')
                ->searchable()
                ->required(),
            Select::make('city_id')
                ->relationship('city', 'name')
                ->label('City')
                ->searchable()
                ->required(),
            Select::make('mother_tongue_id')
                ->relationship('motherTongue', 'name')
                ->label('Mother Tongue')
                ->searchable()
                ->required(),
            Select::make('hobby_id')
                ->relationship('hobby', 'name')
                ->label('Hobby')
                ->searchable()
                ->nullable(),

            Select::make('marital_status')
                ->options([
                    'single' => 'Single',
                    'married' => 'Married',
                    'divorced' => 'Divorced',
                    'widowed' => 'Widowed',
                ])->nullable(),

           Select::make('diet')
            ->label('Diet')
            ->options([
                'veg' => 'Vegetarian',
                'non-veg' => 'Non-Vegetarian',
                'jain' => 'Jain',
                'eggetarian' => 'Eggetarian',
                // add more as needed
            ])
            ->nullable(),
            Select::make('live_with_family')
    ->label('Do You Live With Family?')
    ->options([
        1 => 'Yes',
        0 => 'No',
    ])
    ->nullable(),


            TextInput::make('height')->label('Height (cm)')->numeric()->nullable(),
            TextInput::make('weight')->label('Weight (kg)')->numeric()->nullable(),

            // Career & Education
            TextInput::make('highest_qualification')->maxLength(150)->nullable(),
            TextInput::make('company_position')->maxLength(100)->nullable(),
            TextInput::make('company_name')->label('Company Name')->maxLength(150)->nullable(),
Select::make('income')
    ->label('Income (per annum)')
    ->options([
        'Under ₹3 Lakh' => 'Under ₹3 Lakh',
        '₹3-5 Lakh' => '₹3-5 Lakh',
        '₹5-10 Lakh' => '₹5-10 Lakh',
        '₹10-20 Lakh' => '₹10-20 Lakh',
        'Above ₹20 Lakh' => 'Above ₹20 Lakh',
        'Prefer not to say' => 'Prefer not to say',
    ])
    ->nullable(),

            // Family
            Select::make('family_type')
    ->label('Family Type')
    ->options([
        'Nuclear' => 'Nuclear',
        'Joint' => 'Joint',
        'Extended' => 'Extended',
        'Other' => 'Other',
    ])
    ->nullable(),
TextInput::make('mother_occupation')->label("Mother's Occupation")->nullable(),
TextInput::make('father_occupation')->label("Father's Occupation")->nullable(),
TextInput::make('siblings')->label('Number of Siblings')->numeric()->nullable(),

            // Lifestyle
            Select::make('drinking_habits')->options([
                'no' => 'No',
                'occasionally' => 'Occasionally',
                'yes' => 'Yes',
            ])->nullable(),
            Select::make('smoking_habits')->options([
                'no' => 'No',
                'occasionally' => 'Occasionally',
                'yes' => 'Yes',
            ])->nullable(),
            Select::make('open_to_pets')->options([
                '1' => 'Yes',
                '0' => 'No',
            ])->label('Open to Pets')->nullable(),
            TextInput::make('languages_spoken')->maxLength(255)->nullable(),

            // Horoscope
            TextInput::make('birth_place')->maxLength(150)->nullable(),
            DatePicker::make('birth_date')->nullable(),
            TextInput::make('birth_time')->maxLength(20)->nullable(),
           Select::make('zodiac_sign')
    ->label('Zodiac Sign')
    ->options([
        'Aries' => 'Aries', 'Taurus' => 'Taurus', 'Gemini' => 'Gemini', 'Cancer' => 'Cancer',
        'Leo' => 'Leo', 'Virgo' => 'Virgo', 'Libra' => 'Libra', 'Scorpio' => 'Scorpio',
        'Sagittarius' => 'Sagittarius', 'Capricorn' => 'Capricorn', 'Aquarius' => 'Aquarius', 'Pisces' => 'Pisces'
    ])
    ->nullable(),
            TextInput::make('horoscope_match')->maxLength(50)->nullable(),
            Select::make('zodiac_sign')
    ->label('Zodiac Sign')
    ->options([
        'Aries' => 'Aries', 'Taurus' => 'Taurus', 'Gemini' => 'Gemini', 'Cancer' => 'Cancer',
        'Leo' => 'Leo', 'Virgo' => 'Virgo', 'Libra' => 'Libra', 'Scorpio' => 'Scorpio',
        'Sagittarius' => 'Sagittarius', 'Capricorn' => 'Capricorn', 'Aquarius' => 'Aquarius', 'Pisces' => 'Pisces'
    ])
    ->nullable(),

            // Likes
            TextInput::make('hobbies')->maxLength(255)->nullable(),
            TextInput::make('favorite_music')->maxLength(255)->nullable(),
            TextInput::make('favorite_books')->maxLength(255)->nullable(),
            TextInput::make('favorite_movies')->maxLength(255)->nullable(),
            TextInput::make('favorite_sports')->maxLength(255)->nullable(),

            // Desired Partner
            TextInput::make('desired_age')->maxLength(30)->nullable(),
            TextInput::make('desired_relation_type')->maxLength(50)->nullable(),
            TextInput::make('desired_religion')->maxLength(50)->nullable(),
            TextInput::make('desired_mother_tongue')->maxLength(50)->nullable(),
            TextInput::make('desired_diet')->maxLength(30)->nullable(),
            TextInput::make('desired_state')->maxLength(100)->nullable(),
            TextInput::make('desired_city')->maxLength(100)->nullable(),
            TextInput::make('desired_highest_qualification')->maxLength(150)->nullable(),
            TextInput::make('desired_income')->maxLength(100)->nullable(),

            // Photo
            TextInput::make('photo_path')->label('Profile Photo Path')->nullable(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('user.first_name')->label('First Name')->searchable(),
            TextColumn::make('user.last_name')->label('Last Name')->searchable(),
            TextColumn::make('religion.name')->label('Religion')->searchable(),
            TextColumn::make('caste.name')->label('Caste')->searchable(),
            TextColumn::make('state.name')->label('State')->searchable(),
            TextColumn::make('city.name')->label('City')->searchable(),
            TextColumn::make('motherTongue.name')->label('Mother Tongue')->searchable(),
            TextColumn::make('hobby.name')->label('Hobby')->searchable(),
            TextColumn::make('marital_status')->searchable(),
            TextColumn::make('highest_qualification')->label('Qualification')->searchable(),
            TextColumn::make('company_position')->label('Company Position')->searchable(),
            TextColumn::make('company_name')->label('Company Name')->searchable(),
TextColumn::make('income')->label('Income (per annum)')->searchable(),

            // Add more columns as needed!
             // NEW: Live With Family
        TextColumn::make('live_with_family')
            ->label('Live With Family')
            ->formatStateUsing(fn ($state) => $state === null ? '—' : ($state ? 'Yes' : 'No')),

           

        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit'   => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
    
}

