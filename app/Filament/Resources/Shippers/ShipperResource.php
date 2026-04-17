<?php

namespace App\Filament\Resources\Shippers;

use UnitEnum;
use BackedEnum;

use App\Models\Shipper;

use App\Enums\Role;
use App\Enums\FilamentNavigationGroup;

use App\Filament\Resources\Shippers\Pages\CreateShipper;
use App\Filament\Resources\Shippers\Pages\EditShipper;
use App\Filament\Resources\Shippers\Pages\ListShippers;
use App\Filament\Resources\Shippers\Pages\ViewShipper;
use App\Filament\Resources\Shippers\Schemas\ShipperForm;
use App\Filament\Resources\Shippers\Schemas\ShipperInfolist;
use App\Filament\Resources\Shippers\Tables\ShippersTable;

use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShipperResource extends Resource
{
    protected static ?string $model = Shipper::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    protected static string|UnitEnum|null $navigationGroup = FilamentNavigationGroup::USER_MANAGEMENT;

    protected static ?string $modelLabel = 'Shipper';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ShipperForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ShipperInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShippersTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['roles'])
            ->whereHas('roles', function ($query) {
                $query->where('name', Role::SHIPPER->value);
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
            'index' => ListShippers::route('/'),
            'create' => CreateShipper::route('/create'),
            'view' => ViewShipper::route('/{record}'),
            'edit' => EditShipper::route('/{record}/edit'),
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
