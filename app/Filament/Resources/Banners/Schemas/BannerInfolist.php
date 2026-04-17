<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin banner')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('title')
                            ->label('Tiêu đề')
                            ->columnSpanFull(),

                        ImageEntry::make('banner_image')
                            ->label('Ảnh banner')
                            ->state(fn (mixed $record): string => $record->getFirstMediaUrl('banner', 'banner_webp')
                                ?: ($record->getFirstMediaUrl('banner') ?: ''))
                            ->height(200)
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('Ngày tạo')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Cập nhật lần cuối')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}
