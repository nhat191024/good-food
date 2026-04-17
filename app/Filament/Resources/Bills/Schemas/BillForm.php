<?php

namespace App\Filament\Resources\Bills\Schemas;

use App\Enums\BillStatus;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Restaurant;
use App\Models\Shipper;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin hóa đơn')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('code')
                            ->label('Mã hóa đơn')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('status')
                            ->label('Trạng thái')
                            ->options(BillStatus::class)
                            ->required(),

                        Select::make('customer_id')
                            ->label('Khách hàng')
                            ->options(fn () => Customer::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('restaurant_id')
                            ->label('Nhà hàng')
                            ->options(fn () => Restaurant::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('shipper_id')
                            ->label('Shipper')
                            ->options(fn () => Shipper::query()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Select::make('location_id')
                            ->label('Khu vực')
                            ->options(fn () => Location::whereNull('parent_id')->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('address')
                            ->label('Địa chỉ giao hàng')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),

                        TextInput::make('voucher_code')
                            ->label('Mã voucher')
                            ->nullable()
                            ->maxLength(255),
                    ]),

                Section::make('Thanh toán')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextInput::make('total')
                            ->label('Tổng tiền')
                            ->numeric()
                            ->required()
                            ->suffix('đ'),

                        TextInput::make('discount')
                            ->label('Giảm giá')
                            ->numeric()
                            ->nullable()
                            ->suffix('đ'),

                        TextInput::make('total_final')
                            ->label('Tổng thanh toán')
                            ->numeric()
                            ->required()
                            ->suffix('đ'),

                        Textarea::make('note')
                            ->label('Ghi chú')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
