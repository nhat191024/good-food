<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin danh mục')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên danh mục')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
