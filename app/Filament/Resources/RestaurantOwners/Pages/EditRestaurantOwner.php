<?php

namespace App\Filament\Resources\RestaurantOwners\Pages;

use App\Filament\Resources\RestaurantOwners\RestaurantOwnerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRestaurantOwner extends EditRecord
{
    protected static string $resource = RestaurantOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
