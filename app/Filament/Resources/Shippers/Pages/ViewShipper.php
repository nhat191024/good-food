<?php

namespace App\Filament\Resources\Shippers\Pages;

use App\Filament\Resources\Shippers\ShipperResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewShipper extends ViewRecord
{
    protected static string $resource = ShipperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
