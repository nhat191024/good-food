<?php

namespace App\Models;

use App\Enums\BillStatus;
use Database\Factories\BillFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $restaurant_id
 * @property int $shipper_id
 * @property string $code
 * @property string|null $voucher_code
 * @property int $location_id
 * @property string $address
 * @property int $total
 * @property int $total_final
 * @property int|null $discount
 * @property string|null $note
 * @property BillStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BillDetail> $billDetails
 * @property-read int|null $bill_details_count
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\Location|null $location
 * @property-read \App\Models\Restaurant $restaurant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\Shipper|null $shipper
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereShipperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereTotalFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bill whereVoucherCode($value)
 * @mixin \Eloquent
 */
#[Fillable(['customer_id', 'restaurant_id', 'shipper_id', 'code', 'voucher_code', 'location_id', 'address', 'total', 'total_final', 'discount', 'note', 'status'])]
class Bill extends Model
{
    /** @use HasFactory<BillFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => BillStatus::class,
        ];
    }

    //Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function shipper()
    {
        return $this->belongsTo(Shipper::class, 'shipper_id');
    }

    public function billDetails()
    {
        return $this->hasMany(BillDetail::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
