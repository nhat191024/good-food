<?php

namespace App\Filament\Resources\Restaurants\Schemas;

use App\Enums\RestaurantStatus;
use App\Enums\Role;
use App\Models\Location;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RestaurantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin nhà hàng')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên nhà hàng')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Mô tả')
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        TextInput::make('address')
                            ->label('Địa chỉ')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Select::make('location_id')
                            ->label('Khu vực')
                            ->options(fn () => Location::query()->whereNull('parent_id')->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('commission_percentage')
                            ->label('Phần trăm hoa hồng')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->suffix('%')
                            ->required(),

                        TimePicker::make('opening_time')
                            ->label('Giờ mở cửa')
                            ->required(),

                        TimePicker::make('closing_time')
                            ->label('Giờ đóng cửa')
                            ->required(),

                        Select::make('status')
                            ->label('Trạng thái')
                            ->options(RestaurantStatus::class)
                            ->required(),
                    ]),

                Section::make('Chủ nhà hàng')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('owner_id')
                            ->label('Chủ nhà hàng')
                            ->options(function () {
                                return User::query()
                                    ->where(function ($query) {
                                        $query->role(Role::CUSTOMER->value)
                                            ->orWhereDoesntHave('roles');
                                    })
                                    ->orWhereHas('roles', function ($query) {
                                        $query->where('name', Role::RESTAURANT_OWNER->value);
                                    })
                                    ->get()
                                    ->mapWithKeys(fn (User $user): array => [
                                        $user->id => "{$user->name} ({$user->email})",
                                    ]);
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Chọn người dùng làm chủ nhà hàng. Tài khoản customer sẽ được chuyển thành restaurant owner.'),
                    ]),
            ]);
    }
}
