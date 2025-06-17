<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\UserResource\Pages;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components;
use Filament\Tables\Actions\Action;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Users';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')->required()->maxLength(50),
                TextInput::make('last_name')->maxLength(50),
                TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone')
                    ->maxLength(20),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->visibleOn('create')
                    ->required(fn ($operation) => $operation === 'create'),
                Toggle::make('is_active')->label('Active')->default(true),

                // --- Photo Verification Section (Collapsible) ---
                Components\Section::make('Photo Verification')
                    ->schema([
                        Components\FileUpload::make('profile_photo_path')
                            ->label('Profile Photo')
                            ->disk('public')
                            ->visibility('private')
                            ->image()
                            ->imagePreviewHeight('120')
                            ->disabled(), // only admin view


                        Components\FileUpload::make('selfie_photo_path')
                            ->label('Selfie Photo')
                            ->disk('public')
                            ->visibility('private')
                            ->image()
                            ->imagePreviewHeight('120')
                            ->disabled(), // only admin view

                        // --- Similarity Score (Read Only) ---
                        Components\TextInput::make('photo_similarity')
                            ->label('AWS Rekognition Similarity (%)')
                            ->disabled()
                            ->dehydrated(false),

                        Components\Select::make('photo_verification_status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),

                        Components\Textarea::make('photo_verification_notes')
                            ->label('Admin Notes (if rejected)')
                            ->rows(3)
                            ->maxLength(255),
                    ])
                    ->collapsible(),

            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('profile_photo_path')->label('DB Profile Photo Path'),
                BooleanColumn::make('is_active')->label('Active'),

                // --- Similarity Score in Table ---
                TextColumn::make('photo_similarity')
                    ->label('KYC Similarity (%)')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 2) . '%' : '—'),

                // --- Photo Verification Status Badge ---
                BadgeColumn::make('photo_verification_status')
                    ->label('Photo KYC')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Pending',
                        'verified' => 'Verified',
                        'rejected' => 'Rejected',
                        default => 'Unknown',
                    })
                    ->colors([
                        'pending' => 'warning',
                        'verified' => 'success',
                        'rejected' => 'danger',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                // --- Approve Photo Action ---
                Action::make('approvePhoto')
                    ->label('Approve Photo')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->photo_verification_status !== 'verified')
                    ->action(function ($record) {
                        $record->update([
                            'photo_verification_status' => 'verified',
                            'photo_verification_notes' => 'Approved by admin at ' . now(),
                        ]);
                    }),

                // --- Reject Photo Action ---
                Action::make('rejectPhoto')
                    ->label('Reject Photo')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn ($record) => $record->photo_verification_status !== 'rejected')
                    ->form([
                        Components\Textarea::make('photo_verification_notes')
                            ->label('Reason for rejection')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'photo_verification_status' => 'rejected',
                            'photo_verification_notes' => $data['photo_verification_notes'],
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
