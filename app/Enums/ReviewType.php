<?php

namespace App\Enums;

use App\Models\Restaurant;
use App\Models\Shipper;

enum ReviewType: string
{
    case RESTAURANT = Restaurant::class;
    case SHIPPER = Shipper::class;
}
