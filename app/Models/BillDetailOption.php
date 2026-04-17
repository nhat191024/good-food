<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $bill_detail_id
 * @property int $option_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BillDetail $billDetail
 * @property-read \App\Models\FoodVariation $option
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption whereBillDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BillDetailOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[Fillable(['bill_detail_id', 'option_id'])]
class BillDetailOption extends Model
{
    //Relationships
    public function billDetail()
    {
        return $this->belongsTo(BillDetail::class);
    }

    public function option()
    {
        return $this->belongsTo(FoodVariation::class, 'option_id');
    }
}
