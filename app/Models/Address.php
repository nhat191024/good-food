<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $city_id
 * @property int $ward_id
 * @property string $street_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Location|null $city
 * @property-read \App\Models\Customer|null $reviewer
 * @property-read \App\Models\Location|null $ward
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereStreetAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereWardId($value)
 * @mixin \Eloquent
 */
#[Fillable(['user_id', 'city_id', 'ward_id', 'street_address'])]
class Address extends Model
{
    //Relationships
    public function reviewer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
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
