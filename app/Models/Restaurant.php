<?php

namespace App\Models;

use App\Enums\RestaurantStatus;

use Database\Factories\RestaurantFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property string|null $description
 * @property mixed $opening_time
 * @property mixed $closing_time
 * @property string $address
 * @property int $location_id
 * @property float $rating
 * @property int $rating_count
 * @property int $commission_percentage
 * @property RestaurantStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Food> $foods
 * @property-read int|null $foods_count
 * @property-read \App\Models\Location|null $location
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\RestaurantOwner|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereClosingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereCommissionPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereOpeningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereRatingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[Fillable(['owner_id', 'name', 'description', 'opening_time', 'closing_time', 'address', 'location_id', 'rating', 'commission_percentage', 'status'])]
class Restaurant extends Model implements HasMedia
{
    /** @use HasFactory<RestaurantFactory> */
    use HasFactory, InteractsWithMedia, SoftDeletes;
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => RestaurantStatus::class,
        ];
    }

    /*
    * Register the media collections for the model.
    */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->useDisk('public');

        $this
            ->addMediaCollection('banner')
            ->useDisk('public');
    }

    /**
     * Summary of registerMediaConversions
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar_webp')
            ->width(400)
            ->height(400)
            ->format('webp')
            ->performOnCollections('avatar')
            ->optimize()
            ->queued();

        $this->addMediaConversion('banner_webp')
            ->width(1200)
            ->height(600)
            ->format('webp')
            ->performOnCollections('banner')
            ->optimize()
            ->queued();
    }

    //Relationships
    public function owner()
    {
        return $this->belongsTo(RestaurantOwner::class, 'owner_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
