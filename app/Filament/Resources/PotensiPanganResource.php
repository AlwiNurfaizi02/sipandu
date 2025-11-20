<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PotensiPanganResource\Pages;
use App\Filament\Resources\PotensiPanganResource\RelationManagers;
use App\Models\PotensiPangan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class PotensiPanganResource extends Resource
{
    protected static ?string $model = PotensiPangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('judul')
                    ->label('Nama eduwisata')
                    ->required(),

                Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'ternak' => 'Ternak',
                        'karbo' => 'Karbo',
                        'sayur dan buah' => 'Sayur dan Buah',
                    ])
                    ->required(),

                TextInput::make('link_video')
                    ->placeholder('https://drive.google.com/...')
                    ->label('Masukan link video'),
                // ->required(),

                TextInput::make('jurnal')
                    ->placeholder('https://drive.google.com/...')
                    ->label('Masukan link jurnal'),
                // ->required(),

                TextInput::make('latitude')
                    ->label('latitude')
                    ->placeholder('-7.3367051')
                    ->required(),

                TextInput::make('longitude')
                    ->placeholder('108.1509026')
                    ->label('longitude')
                    ->required(),

                TextArea::make('alamat')
                    ->label('Alamat')
                    ->required(),

                TextArea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required()
                    ->maxLength(200)
                    ->columnSpanFull(),

                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->image()
                    ->directory('potensipangans')
                    ->maxSize(2048) // maksimal 2MB
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul'),
                TextColumn::make('kategori'),
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
            'index' => Pages\ListPotensiPangans::route('/'),
            'create' => Pages\CreatePotensiPangan::route('/create'),
            'edit' => Pages\EditPotensiPangan::route('/{record}/edit'),
        ];
    }
}
