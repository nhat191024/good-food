<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $bill_id
 * @property int $food_id
 * @property int $price
 * @property int $quantity
 * @property int $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bill $bill
 * @property-read \App\Models\Food $food
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail whereBillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[Fillable(['bill_id', 'food_id', 'price', 'quantity', 'total'])]
class BillDetail extends Model
{
    //Relationships
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
