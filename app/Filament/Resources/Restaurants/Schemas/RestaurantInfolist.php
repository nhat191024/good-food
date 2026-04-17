<?php

namespace App\Filament\Resources\Restaurants\Schemas;

use App\Models\Restaurant;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class RestaurantInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin nhà hàng')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('avatar')
                            ->label('Ảnh đại diện')
                            ->getStateUsing(fn (Restaurant $record): ?string => $record->getFirstMediaUrl('avatar', 'avatar_webp') ?: $record->getFirstMediaUrl('avatar'))
                            ->circular(),

                        ImageEntry::make('banner')
                            ->label('Banner')
                            ->getStateUsing(fn (Restaurant $record): ?string => $record->getFirstMediaUrl('banner', 'banner_webp') ?: $record->getFirstMediaUrl('banner'))
                            ->columnSpan(1),

                        TextEntry::make('name')
                            ->label('Tên nhà hàng')
                            ->columnSpanFull(),

                        TextEntry::make('description')
                            ->label('Mô tả')
                            ->placeholder('Chưa có mô tả')
                            ->columnSpanFull(),

                        TextEntry::make('address')
                            ->label('Địa chỉ'),

                        TextEntry::make('location.name')
                            ->label('Khu vực')
                            ->placeholder('Chưa cập nhật'),

                        TextEntry::make('opening_time')
                            ->label('Giờ mở cửa')
                            ->time('H:i'),

                        TextEntry::make('closing_time')
                            ->label('Giờ đóng cửa')
                            ->time('H:i'),

                        TextEntry::make('rating')
                            ->label('Đánh giá')
                            ->suffix(' / 5'),

                        TextEntry::make('rating_count')
                            ->label('Số lượt đánh giá'),

                        TextEntry::make('commission_percentage')
                            ->label('Hoa hồng')
                            ->suffix('%'),

                        TextEntry::make('status')
                            ->label('Trạng thái')
                            ->badge()
                            ->color(fn ($state) => match ($state?->value) {
                                'active'   => 'success',
                                'inactive' => 'danger',
                                default    => 'gray',
                            }),

                        TextEntry::make('created_at')
                            ->label('Ngày tạo')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('deleted_at')
                            ->label('Ngày bị cấm')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Đang hoạt động'),
                    ]),

                Section::make('Chủ nhà hàng')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('owner.name')
                            ->label('Họ và tên'),

                        TextEntry::make('owner.email')
                            ->label('Email'),

                        TextEntry::make('owner.phone')
                            ->label('Số điện thoại')
                            ->placeholder('Chưa cập nhật'),
                    ]),

                Section::make('Menu nhà hàng')
                    ->columnSpanFull()
                    ->schema([
                        RepeatableEntry::make('categories')
                            ->label('')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Danh mục')
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('description')
                                    ->label('Mô tả danh mục')
                                    ->placeholder('Không có mô tả')
                                    ->columnSpanFull(),

                                RepeatableEntry::make('foods')
                                    ->label('Món ăn')
                                    ->columnSpanFull()
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Tên món'),

                                        TextEntry::make('price')
                                            ->label('Giá')
                                            ->money('VND'),

                                        TextEntry::make('description')
                                            ->label('Mô tả')
                                            ->placeholder('Không có mô tả'),

                                        IconEntry::make('is_available')
                                            ->label('Còn phục vụ')
                                            ->boolean(),

                                        RepeatableEntry::make('variations')
                                            ->label('Biến thể')
                                            ->columnSpanFull()
                                            ->schema([
                                                TextEntry::make('group')
                                                    ->label('Nhóm')
                                                    ->placeholder('Không có nhóm'),

                                                TextEntry::make('name')
                                                    ->label('Tên biến thể'),

                                                TextEntry::make('price')
                                                    ->label('Giá cộng thêm')
                                                    ->money('VND'),

                                                IconEntry::make('is_available')
                                                    ->label('Còn phục vụ')
                                                    ->boolean(),
                                            ]),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
