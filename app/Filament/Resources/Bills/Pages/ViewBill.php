<?php

namespace App\Filament\Resources\Bills\Pages;

use App\Enums\BillStatus;
use App\Filament\Resources\Bills\BillResource;
use App\Models\Bill;
use App\Models\Shipper;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;

class ViewBill extends ViewRecord
{
    protected static string $resource = BillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('changeStatus')
                ->label('Đổi trạng thái')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->schema([
                    Select::make('status')
                        ->label('Trạng thái mới')
                        ->options(BillStatus::class)
                        ->default(fn () => $this->record->status->value)
                        ->required(),

                    Select::make('shipper_id')
                        ->label('Shipper')
                        ->options(fn () => Shipper::query()->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->default(fn () => $this->record->shipper_id)
                        ->helperText('Chỉ định lại shipper nếu cần'),
                ])
                ->action(function (array $data, Bill $record): void {
                    $record->update(array_filter([
                        'status' => $data['status'],
                        'shipper_id' => $data['shipper_id'] ?? $record->shipper_id,
                    ]));
                })
                ->requiresConfirmation()
                ->modalHeading('Thay đổi trạng thái hóa đơn')
                ->modalDescription('Hành động này sẽ cập nhật trạng thái hóa đơn. Xác nhận để tiếp tục.'),

            EditAction::make(),

            DeleteAction::make(),
        ];
    }
}
