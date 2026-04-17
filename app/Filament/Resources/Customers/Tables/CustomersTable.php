<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Ảnh')
                    ->circular()
                    ->defaultImageUrl(fn ($record): string => $record->avatar),

                TextColumn::make('name')
                    ->label('Họ và tên')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->searchable()
                    ->placeholder('Chưa cập nhật'),

                TextColumn::make('gender')
                    ->label('Giới tính')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'male' => 'Nam',
                        'female' => 'Nữ',
                        'other' => 'Khác',
                        default => 'Chưa cập nhật',
                    }),

                TextColumn::make('birthday')
                    ->label('Ngày sinh')
                    ->date('d/m/Y')
                    ->placeholder('Chưa cập nhật')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_verified')
                    ->label('Xác minh')
                    ->boolean()
                    ->trueIcon(Heroicon::CheckBadge)
                    ->falseIcon(Heroicon::XCircle)
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                TernaryFilter::make('is_verified')
                    ->label('Xác minh')
                    ->trueLabel('Đã xác minh')
                    ->falseLabel('Chưa xác minh'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('verify')
                    ->label(fn ($record): string => $record->is_verified ? 'Hủy xác minh' : 'Xác minh')
                    ->icon(fn ($record): Heroicon => $record->is_verified ? Heroicon::XCircle : Heroicon::CheckBadge)
                    ->color(fn ($record): string => $record->is_verified ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading(fn ($record): string => $record->is_verified ? 'Hủy xác minh khách hàng' : 'Xác minh khách hàng')
                    ->modalDescription(fn ($record): string => $record->is_verified
                        ? 'Bạn có chắc chắn muốn hủy xác minh khách hàng này không?'
                        : 'Bạn có chắc chắn muốn xác minh khách hàng này không?')
                    ->action(fn ($record) => $record->update(['is_verified' => ! $record->is_verified])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
