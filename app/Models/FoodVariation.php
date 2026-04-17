<?php

namespace App\Models;

use Database\Factories\FoodVariationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $food_id
 * @property string $name
 * @property string|null $description
 * @property int $price
 * @property string|null $group
 * @property int $is_available
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Food $food
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodVariation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[Fillable(['food_id', 'name', 'description', 'price',  'group', 'is_available'])]
class FoodVariation extends Model
{
    /** @use HasFactory<FoodVariationFactory> */
    use HasFactory;
    //Relationships
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
