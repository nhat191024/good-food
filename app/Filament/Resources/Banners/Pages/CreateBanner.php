<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    protected ?string $bannerImagePath = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->bannerImagePath = $data['banner_image'] ?? null;
        unset($data['banner_image']);

        return $data;
    }

    protected function afterCreate(): void
    {
        if ($this->bannerImagePath) {
            $this->record
                ->clearMediaCollection('banner')
                ->addMedia(Storage::disk('public')->path($this->bannerImagePath))
                ->toMediaCollection('banner');
        }
    }
}
