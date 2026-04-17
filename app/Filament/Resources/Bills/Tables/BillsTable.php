<?php

namespace App\Filament\Resources\Bills\Tables;

use App\Enums\BillStatus;
use App\Models\Bill;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Mã hóa đơn')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('customer.name')
                    ->label('Khách hàng')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('restaurant.name')
                    ->label('Nhà hàng')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('shipper.name')
                    ->label('Shipper')
                    ->placeholder('Chưa có')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('total_final')
                    ->label('Thanh toán')
                    ->state(fn (Bill $record): string => number_format($record->total_final) . ' đ')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options(BillStatus::class),

                SelectFilter::make('restaurant_id')
                    ->label('Nhà hàng')
                    ->relationship('restaurant', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('changeStatus')
                    ->label('Đổi trạng thái')
                    ->icon(Heroicon::OutlinedArrowPath)
                    ->color('warning')
                    ->schema([
                        Select::make('status')
                            ->label('Trạng thái mới')
                            ->options(BillStatus::class)
                            ->required(),
                    ])
                    ->action(fn (array $data, Bill $record) => $record->update(['status' => $data['status']])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
