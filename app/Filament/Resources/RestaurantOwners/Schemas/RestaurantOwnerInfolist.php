<?php

namespace App\Filament\Resources\RestaurantOwners\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RestaurantOwnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin chủ nhà hàng')
                    ->columnSpanFull()
                    ->schema([
                        ImageEntry::make('avatar')
                            ->label('Ảnh đại diện')
                            ->circular()
                            ->columnSpanFull(),

                        TextEntry::make('name')
                            ->label('Họ và tên'),

                        TextEntry::make('email')
                            ->label('Email'),

                        TextEntry::make('phone')
                            ->label('Số điện thoại')
                            ->placeholder('Chưa cập nhật'),

                        TextEntry::make('gender')
                            ->label('Giới tính')
                            ->formatStateUsing(fn(?string $state): string => match ($state) {
                                'male' => 'Nam',
                                'female' => 'Nữ',
                                'other' => 'Khác',
                                default => 'Chưa cập nhật',
                            }),

                        TextEntry::make('birthday')
                            ->label('Ngày sinh')
                            ->date('d/m/Y')
                            ->placeholder('Chưa cập nhật'),

                        TextEntry::make('restaurants_count')
                            ->label('Số nhà hàng')
                            ->state(fn($record): int => $record->restaurants()->count()),

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
