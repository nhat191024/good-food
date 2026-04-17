<?php

namespace App\Filament\Resources\Restaurants\Pages;

use App\Filament\Resources\Restaurants\RestaurantResource;
use App\Models\Restaurant;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewRestaurant extends ViewRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            RestoreAction::make(),

            DeleteAction::make()
                ->label('Cấm nhà hàng')
                ->modalHeading('Cấm nhà hàng này?')
                ->modalDescription('Nhà hàng sẽ bị ẩn khỏi hệ thống. Bạn có thể khôi phục lại bất cứ lúc nào.')
                ->modalSubmitActionLabel('Cấm'),
        ];
    }

    protected function resolveRecord(int|string $key): Model
    {
        return Restaurant::withTrashed()
            ->with(['owner', 'location', 'categories.foods.variations'])
            ->findOrFail($key);
    }
}
