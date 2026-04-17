<?php

use Illuminate\Support\Facades\Artisan;

use App\Models\Food;

Artisan::command('test', function () {
    $food = Food::all();

    $this->info($food);
})->purpose('For testing purposes');
