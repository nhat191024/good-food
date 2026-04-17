<?php

namespace App\Filament\Resources\Restaurants\Pages;

use App\Enums\Role;
use App\Filament\Resources\Restaurants\RestaurantResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateRestaurant extends CreateRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function afterCreate(): void
    {
        $ownerId = $this->record->owner_id;

        if (! $ownerId) {
            return;
        }

        $owner = User::find($ownerId);

        if (! $owner) {
            return;
        }

        if ($owner->hasRole(Role::CUSTOMER->value)) {
            $owner->removeRole(Role::CUSTOMER->value);
        }

        if (! $owner->hasRole(Role::RESTAURANT_OWNER->value)) {
            $owner->assignRole(Role::RESTAURANT_OWNER->value);
        }
    }
}
