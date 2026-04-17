<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public string $app_name;
    public string $app_logo;
    public string $app_favicon;
    public int $commission_percentage;

    /**
     * Get the settings group name.
     */
    public static function group(): string
    {
        return 'appSettings';
    }
}
