<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'city_id', 'ward_id', 'street_address'])]
class Address extends Model
{
    //Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id');
    }

    public function ward()
    {
        return $this->belongsTo(Location::class, 'ward_id');
    }
}
