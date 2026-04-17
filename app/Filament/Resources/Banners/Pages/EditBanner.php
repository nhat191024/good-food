<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected ?string $bannerImagePath = null;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->bannerImagePath = $data['banner_image'] ?? null;
        unset($data['banner_image']);

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->bannerImagePath) {
            $this->record
                ->clearMediaCollection('banner')
                ->addMedia(Storage::disk('public')->path($this->bannerImagePath))
                ->toMediaCollection('banner');
        }
    }
}
