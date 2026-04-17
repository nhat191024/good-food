<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $restaurant_id
 * @property string $code
 * @property string|null $description
 * @property string|null $data
 * @property int|null $discount_percentage
 * @property int|null $minimum_order_amount
 * @property int|null $maximum_discount_amount
 * @property string|null $valid_from
 * @property string|null $valid_until
 * @property int|null $usage_limit
 * @property int $used_count
 * @property int $is_unlimited
 * @property int $is_global
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Restaurant|null $restaurant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereDiscountPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereIsUnlimited($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereMaximumDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereMinimumOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereUsageLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereUsedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher whereValidUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voucher withoutTrashed()
 * @mixin \Eloquent
 */
#[Fillable(['code', 'description', 'data', 'discount_percentage', 'minimum_order_amount', 'maximum_discount_amount', 'valid_from', 'valid_until', 'usage_limit', 'used_count', 'is_unlimited', 'is_global'])]
class Voucher extends Model
{
    use SoftDeletes;

    //Relationships
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
