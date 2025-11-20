<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketResource\Pages;
use App\Filament\Resources\MarketResource\RelationManagers;
use App\Models\Market;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
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


class MarketResource extends Resource
{
    protected static ?string $model = Market::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('produk_pangan')
                    ->label('nama porduk')
                    ->required(),

                TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('latitude')
                    ->label('latitude')
                    ->required(),

                TextInput::make('longitude')
                    ->label('longitude')
                    ->required(),

                TextInput::make('nomor_hp')
                    ->label('Nomor WhatsApp')
                    ->required()
                    ->maxLength(15)
                    ->placeholder('Contoh: 082216367812')
                    ->rule('regex:/^(\\+?62|0)[0-9]{8,13}$/') // Validasi format WA
                    ->validationMessages([
                        'regex' => 'Nomor WhatsApp tidak valid. Format benar: 08xxxxxxxxxx atau +628xxxxxxxxxx.',
                    ])
                    ->formatStateUsing(function ($state) {
                        if (!$state) return null;

                        // Hilangkan karakter non-digit
                        $clean = preg_replace('/\D/', '', $state);

                        // Jika diawali 0 -> +62
                        if (str_starts_with($clean, '0')) {
                            return '+62 ' . substr($clean, 1);
                        }

                        // Jika diawali 62 tanpa + -> tambahkan +
                        if (str_starts_with($clean, '62')) {
                            return '+' . $clean;
                        }

                        // Jika sudah +62...
                        if (str_starts_with($state, '+62')) {
                            return $state;
                        }

                        return '+62 ' . $clean;
                    })
                    ->dehydrateStateUsing(function ($state) {
                        if (!$state) return null;

                        // Hilangkan spasi/simbol
                        $clean = preg_replace('/\D/', '', $state);

                        // Jika diawali 0 → ubah menjadi 62 + sisanya
                        if (str_starts_with($clean, '0')) {
                            $clean = '62' . substr($clean, 1);
                        }

                        // Pastikan format final adalah +62...
                        return '+' . $clean;
                    }),


                // TextInput::make('nomor_hp')
                //     ->label('Nomer Whatsapp')
                //     ->maxLength(13)
                //     ->required(),

                Textarea::make('deskripsi')
                    ->label('deskripsi')
                    ->maxLength(200),

                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('markets')
                    ->maxSize(2048) // maksimal 2MB
                    ->imagePreviewHeight('150')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('produk_pangan'),

                TextColumn::make('harga')
                    ->formatStateUsing(fn($state) => 'Rp' . number_format($state, 0, ',', '.')),
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
            'index' => Pages\ListMarkets::route('/'),
            'create' => Pages\CreateMarket::route('/create'),
            'edit' => Pages\EditMarket::route('/{record}/edit'),
        ];
    }
}
