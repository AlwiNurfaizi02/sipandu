<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Filament\Resources\select;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?string $pluralModelLabel = 'Akun';
    protected static ?string $modelLabel = 'Akun';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name'),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn($context) => $context === 'create') // wajib saat buat akun
                    ->same('password_confirmation')
                    ->dehydrateStateUsing(
                        fn($state) =>
                        $state ? Hash::make($state) : null
                    )
                    ->dehydrated(fn($state) => filled($state))
                    ->label('Password'),

                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->required(fn($context) => $context === 'create')
                    ->label('Konfirmasi Password')
                    ->dehydrated(false), // tidak disimpan ke DB
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                // Tables\Columns\TextColumn::make('roles')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
