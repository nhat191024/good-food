<?php

namespace App\Filament\Resources\Vouchers\Schemas;

use App\Models\Restaurant;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class VoucherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin voucher')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('code')
                            ->label('Mã voucher')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        Toggle::make('is_global')
                            ->label('Áp dụng toàn hệ thống')
                            ->live()
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Đang hoạt động')
                            ->default(true),

                        Select::make('restaurant_id')
                            ->label('Nhà hàng')
                            ->options(fn () => Restaurant::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->hidden(fn (Get $get): bool => (bool) $get('is_global'))
                            ->columnSpanFull(),
                    ]),

                Section::make('Điều kiện giảm giá')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('discount_percentage')
                            ->label('Phần trăm giảm giá')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->suffix('%')
                            ->required(),

                        TextInput::make('minimum_order_amount')
                            ->label('Đơn hàng tối thiểu')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('đ'),

                        TextInput::make('maximum_discount_amount')
                            ->label('Giảm tối đa')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('đ'),
                    ]),

                Section::make('Thời hạn & lượt dùng')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('valid_from')
                            ->label('Hiệu lực từ')
                            ->displayFormat('d/m/Y H:i'),

                        DateTimePicker::make('valid_until')
                            ->label('Hết hạn')
                            ->displayFormat('d/m/Y H:i')
                            ->after('valid_from'),

                        Toggle::make('is_unlimited')
                            ->label('Không giới hạn lượt dùng')
                            ->live()
                            ->default(false),

                        TextInput::make('usage_limit')
                            ->label('Giới hạn lượt dùng')
                            ->numeric()
                            ->minValue(1)
                            ->hidden(fn (Get $get): bool => (bool) $get('is_unlimited')),
                    ]),
            ]);
    }
}
