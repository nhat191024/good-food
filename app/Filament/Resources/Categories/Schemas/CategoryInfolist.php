<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin danh mục')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('name')
                            ->label('Tên danh mục')
                            ->columnSpanFull(),

                        TextEntry::make('description')
                            ->label('Mô tả')
                            ->placeholder('Chưa có mô tả')
                            ->columnSpanFull(),

                        TextEntry::make('subcategories_count')
                            ->label('Số danh mục con')
                            ->state(fn($record): int => $record->subcategories()->count()),

                        TextEntry::make('created_at')
                            ->label('Ngày tạo')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('deleted_at')
                            ->label('Ngày xóa')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Đang hoạt động'),
                    ]),
            ]);
    }
}
