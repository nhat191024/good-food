<?php

namespace App\Filament\Resources\Vouchers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VouchersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Mã voucher')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('restaurant.name')
                    ->label('Nhà hàng')
                    ->placeholder('Toàn hệ thống')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('discount_percentage')
                    ->label('Giảm giá')
                    ->suffix('%')
                    ->sortable(),

                TextColumn::make('used_count')
                    ->label('Đã dùng')
                    ->sortable(),

                TextColumn::make('usage_limit')
                    ->label('Giới hạn')
                    ->placeholder('Không giới hạn')
                    ->sortable(),

                TextColumn::make('valid_until')
                    ->label('Hết hạn')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('Không giới hạn')
                    ->sortable(),

                IconColumn::make('is_global')
                    ->label('Toàn hệ thống')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->label('Hoạt động')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),

                TernaryFilter::make('is_active')
                    ->label('Trạng thái'),

                TernaryFilter::make('is_global')
                    ->label('Toàn hệ thống'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
