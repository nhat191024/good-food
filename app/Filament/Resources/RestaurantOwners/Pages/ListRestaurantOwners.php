<?php

namespace App\Filament\Resources\RestaurantOwners\Pages;

use App\Filament\Resources\RestaurantOwners\RestaurantOwnerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRestaurantOwners extends ListRecords
{
    protected static string $resource = RestaurantOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
