<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class SubcategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'subcategories';

    protected static ?string $title = 'Danh mục con';

    protected static ?string $modelLabel = 'danh mục con';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Tên danh mục con')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('restaurant.name')
                    ->label('Nhà hàng')
                    ->placeholder('Không có')
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Mô tả')
                    ->limit(60)
                    ->placeholder('Chưa có mô tả')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('foods_count')
                    ->label('Số món ăn')
                    ->counts('foods')
                    ->sortable(),

                TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ]);
    }
}
