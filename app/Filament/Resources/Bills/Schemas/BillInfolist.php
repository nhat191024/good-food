<?php

namespace App\Filament\Resources\Bills\Schemas;

use App\Models\Bill;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BillInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin hóa đơn')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('code')
                            ->label('Mã hóa đơn')
                            ->copyable(),

                        TextEntry::make('status')
                            ->label('Trạng thái')
                            ->badge(),

                        TextEntry::make('customer.name')
                            ->label('Khách hàng'),

                        TextEntry::make('restaurant.name')
                            ->label('Nhà hàng'),

                        TextEntry::make('shipper.name')
                            ->label('Shipper')
                            ->placeholder('Chưa có'),

                        TextEntry::make('location.name')
                            ->label('Khu vực')
                            ->placeholder('Chưa cập nhật'),

                        TextEntry::make('address')
                            ->label('Địa chỉ giao hàng')
                            ->columnSpanFull(),

                        TextEntry::make('voucher_code')
                            ->label('Mã voucher')
                            ->placeholder('Không có'),

                        TextEntry::make('note')
                            ->label('Ghi chú')
                            ->placeholder('Không có')
                            ->columnSpanFull(),
                    ]),

                Section::make('Thanh toán')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('total')
                            ->label('Tổng tiền')
                            ->state(fn (Bill $record): string => number_format($record->total) . ' đ'),

                        TextEntry::make('discount')
                            ->label('Giảm giá')
                            ->state(fn (Bill $record): string => number_format($record->discount ?? 0) . ' đ'),

                        TextEntry::make('total_final')
                            ->label('Tổng thanh toán')
                            ->state(fn (Bill $record): string => number_format($record->total_final) . ' đ'),
                    ]),

                Section::make('Thời gian')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Ngày đặt')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Cập nhật lần cuối')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]);
    }
}
