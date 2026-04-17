<?php

namespace App\Filament\Pages;

use App\Enums\FilamentNavigationGroup;
use App\Settings\AppSettings;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class AppManager extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string $settings = AppSettings::class;

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return FilamentNavigationGroup::SETTINGS;
    }

    public static function getNavigationLabel(): string
    {
        return 'Cài đặt ứng dụng';
    }

    public function getTitle(): string
    {
        return 'Cài đặt ứng dụng';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin chung')
                    ->description('Cấu hình tên và hình ảnh của ứng dụng.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('app_name')
                            ->label('Tên ứng dụng')
                            ->columnSpanFull()
                            ->required(),

                        FileUpload::make('app_logo')
                            ->label('Logo')
                            ->image()
                            ->directory('uploads/app')
                            ->disk('public')
                            ->visibility('public')
                            ->formatStateUsing(fn ($state) => $state ? str_replace('storage/', '', $state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(function ($state, $record) {
                                if (filled($state)) {
                                    if (str_starts_with($state, 'images/')) {
                                        return $state;
                                    }

                                    return 'storage/'.$state;
                                }

                                return $record?->app_logo ?? null;
                            }),

                        FileUpload::make('app_favicon')
                            ->label('Favicon')
                            ->image()
                            ->directory('uploads/app')
                            ->disk('public')
                            ->visibility('public')
                            ->formatStateUsing(fn ($state) => $state ? str_replace('storage/', '', $state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(function ($state, $record) {
                                if (filled($state)) {
                                    if (str_starts_with($state, 'images/')) {
                                        return $state;
                                    }

                                    return 'storage/'.$state;
                                }

                                return $record?->app_favicon ?? null;
                            }),
                    ]),

                Section::make('Cài đặt hoa hồng')
                    ->description('Cấu hình tỷ lệ hoa hồng mặc định cho nhà hàng.')
                    ->schema([
                        TextInput::make('commission_percentage')
                            ->label('Tỷ lệ hoa hồng (%)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%')
                            ->required(),
                    ]),
            ]);
    }
}
