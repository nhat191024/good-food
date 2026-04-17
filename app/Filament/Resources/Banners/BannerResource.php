<?php

namespace App\Filament\Resources\Banners;

use UnitEnum;
use BackedEnum;

use App\Models\Banner;

use App\Enums\FilamentNavigationGroup;

// use App\Filament\Resources\Banners\Pages\CreateBanner;
// use App\Filament\Resources\Banners\Pages\EditBanner;
use App\Filament\Resources\Banners\Pages\ListBanners;
use App\Filament\Resources\Banners\Pages\ViewBanner;
use App\Filament\Resources\Banners\Schemas\BannerForm;
use App\Filament\Resources\Banners\Schemas\BannerInfolist;
use App\Filament\Resources\Banners\Tables\BannersTable;

use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = FilamentNavigationGroup::GENERAL;

    protected static ?string $modelLabel = 'Banner';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return BannerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BannerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BannersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBanners::route('/'),
            // 'create' => CreateBanner::route('/create'),
            'view' => ViewBanner::route('/{record}'),
            // 'edit' => EditBanner::route('/{record}/edit'),
        ];
    }
}
