<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case CUSTOMER = 'customer';
    case RESTAURANT_OWNER = 'restaurant_owner';
    case SHIPPER = 'shipper';
}
