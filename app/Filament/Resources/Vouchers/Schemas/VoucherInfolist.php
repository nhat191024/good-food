<?php

namespace App\Filament\Resources\Vouchers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VoucherInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin voucher')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('code')
                            ->label('Mã voucher')
                            ->columnSpanFull()
                            ->copyable(),

                        TextEntry::make('description')
                            ->label('Mô tả')
                            ->placeholder('Chưa có mô tả')
                            ->columnSpanFull(),

                        TextEntry::make('restaurant.name')
                            ->label('Nhà hàng')
                            ->placeholder('Toàn hệ thống'),

                        IconEntry::make('is_global')
                            ->label('Toàn hệ thống')
                            ->boolean(),

                        IconEntry::make('is_active')
                            ->label('Đang hoạt động')
                            ->boolean(),
                    ]),

                Section::make('Điều kiện giảm giá')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('discount_percentage')
                            ->label('Phần trăm giảm giá')
                            ->suffix('%')
                            ->placeholder('—'),

                        TextEntry::make('minimum_order_amount')
                            ->label('Đơn hàng tối thiểu')
                            ->numeric()
                            ->suffix('đ')
                            ->placeholder('—'),

                        TextEntry::make('maximum_discount_amount')
                            ->label('Giảm tối đa')
                            ->numeric()
                            ->suffix('đ')
                            ->placeholder('—'),
                    ]),

                Section::make('Thời hạn & lượt dùng')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('valid_from')
                            ->label('Hiệu lực từ')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Không giới hạn'),

                        TextEntry::make('valid_until')
                            ->label('Hết hạn')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Không giới hạn'),

                        IconEntry::make('is_unlimited')
                            ->label('Không giới hạn lượt dùng')
                            ->boolean(),

                        TextEntry::make('usage_limit')
                            ->label('Giới hạn lượt dùng')
                            ->placeholder('Không giới hạn'),

                        TextEntry::make('used_count')
                            ->label('Đã dùng'),

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
