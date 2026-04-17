<?php

namespace App\Filament\Resources\Restaurants\Tables;

use App\Enums\RestaurantStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class RestaurantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Ảnh')
                    ->circular()
                    ->getStateUsing(fn($record): ?string => $record->getFirstMediaUrl('avatar', 'avatar_webp') ?: $record->getFirstMediaUrl('avatar')),

                TextColumn::make('name')
                    ->label('Tên nhà hàng')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('owner.name')
                    ->label('Chủ nhà hàng')
                    ->searchable()
                    ->placeholder('Chưa có'),

                TextColumn::make('location.name')
                    ->label('Khu vực')
                    ->placeholder('Chưa cập nhật')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('address')
                    ->label('Địa chỉ')
                    ->limit(40)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('rating')
                    ->label('Đánh giá')
                    ->suffix(' / 5')
                    ->sortable(),

                TextColumn::make('commission_percentage')
                    ->label('Hoa hồng')
                    ->suffix('%')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(RestaurantStatus $state): string => match ($state) {
                        RestaurantStatus::ACTIVE   => 'success',
                        RestaurantStatus::INACTIVE => 'danger',
                    }),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),

                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options(RestaurantStatus::class),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Cấm nhà hàng đã chọn'),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make()
                        ->label('Khôi phục nhà hàng đã chọn'),
                ]),
            ]);
    }
}
