<?php

namespace App\Filament\Resources\Bills\RelationManagers;

use App\Models\BillDetail;
use App\Models\BillDetailOption;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BillDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'billDetails';

    protected static ?string $title = 'Chi tiết đơn hàng';

    protected static ?string $modelLabel = 'chi tiết';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('food.name')
                ->label('Món ăn'),

            TextEntry::make('price')
                ->label('Đơn giá')
                ->state(fn (BillDetail $record): string => number_format($record->price) . ' đ'),

            TextEntry::make('quantity')
                ->label('Số lượng'),

            TextEntry::make('total')
                ->label('Thành tiền')
                ->state(fn (BillDetail $record): string => number_format($record->total) . ' đ'),

            RepeatableEntry::make('options')
                ->label('Tùy chọn')
                ->relationship('options')
                ->schema([
                    TextEntry::make('option.name')
                        ->label('Tên tùy chọn')
                        ->hiddenLabel(),

                    TextEntry::make('option.price')
                        ->label('Giá')
                        ->state(fn (BillDetailOption $record): string => number_format($record->option->price) . ' đ')
                        ->hiddenLabel(),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('food.name')
                    ->label('Món ăn')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Đơn giá')
                    ->state(fn (BillDetail $record): string => number_format($record->price) . ' đ'),

                TextColumn::make('quantity')
                    ->label('Số lượng'),

                TextColumn::make('total')
                    ->label('Thành tiền')
                    ->state(fn (BillDetail $record): string => number_format($record->total) . ' đ'),
            ])
            ->defaultSort('id', 'asc');
    }
}
