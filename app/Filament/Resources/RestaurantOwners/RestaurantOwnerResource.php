<?php

namespace App\Filament\Resources\RestaurantOwners;


use UnitEnum;
use BackedEnum;

use App\Models\RestaurantOwner;

use App\Enums\Role;
use App\Enums\FilamentNavigationGroup;

// use App\Filament\Resources\RestaurantOwners\Pages\CreateRestaurantOwner;
// use App\Filament\Resources\RestaurantOwners\Pages\EditRestaurantOwner;
use App\Filament\Resources\RestaurantOwners\Pages\ListRestaurantOwners;
use App\Filament\Resources\RestaurantOwners\Pages\ViewRestaurantOwner;
use App\Filament\Resources\RestaurantOwners\Schemas\RestaurantOwnerForm;
use App\Filament\Resources\RestaurantOwners\Schemas\RestaurantOwnerInfolist;
use App\Filament\Resources\RestaurantOwners\Tables\RestaurantOwnersTable;

use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RestaurantOwnerResource extends Resource
{
    protected static ?string $model = RestaurantOwner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static string|UnitEnum|null $navigationGroup = FilamentNavigationGroup::USER_MANAGEMENT;

    protected static ?string $modelLabel = 'Chủ nhà hàng';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RestaurantOwnerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RestaurantOwnerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RestaurantOwnersTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['partnerProfile', 'roles', 'wallet'])
            ->whereHas('roles', function ($query) {
                $query->where('name', Role::RESTAURANT_OWNER->value);
            });
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
            'index' => ListRestaurantOwners::route('/'),
            // 'create' => CreateRestaurantOwner::route('/create'),
            'view' => ViewRestaurantOwner::route('/{record}'),
            // 'edit' => EditRestaurantOwner::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
