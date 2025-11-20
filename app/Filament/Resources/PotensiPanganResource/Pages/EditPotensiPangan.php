<?php

namespace App\Filament\Resources\PotensiPanganResource\Pages;

use App\Filament\Resources\PotensiPanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPotensiPangan extends EditRecord
{
    protected static string $resource = PotensiPanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
