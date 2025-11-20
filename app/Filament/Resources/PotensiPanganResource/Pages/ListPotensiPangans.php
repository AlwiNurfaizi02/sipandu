<?php

namespace App\Filament\Resources\PotensiPanganResource\Pages;

use App\Filament\Resources\PotensiPanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPotensiPangans extends ListRecords
{
    protected static string $resource = PotensiPanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
