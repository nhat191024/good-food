<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'code', 'codename', 'short_codename', 'type', 'phone_code', 'parent_id'])]
class Location extends Model
{
    use SoftDeletes;

    //Relationships
    public function province()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function wards()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }
}
