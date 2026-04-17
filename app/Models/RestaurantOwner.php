<?php

namespace App\Models;

use Database\Factories\RestaurantOwnerFactory;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Support\LogOptions;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Restaurant> $restaurants
 * @property-read int|null $restaurants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner permission($permissions, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner role($roles, ?string $guard = null, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner withoutRole($roles, ?string $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RestaurantOwner withoutTrashed()
 * @mixin \Eloquent
 */
#[Table('users')]
#[Guarded(['web'])]
class RestaurantOwner extends User
{
    /** @use HasFactory<RestaurantOwnerFactory> */
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): RestaurantOwnerFactory
    {
        return RestaurantOwnerFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['email', 'name', 'phone', 'gender', 'birthday', 'status'])
            ->logOnlyDirty()
            ->useLogName('user_management')
            ->setDescriptionForEvent(function (string $eventName) {
                return "Restaurant owner account has been {$eventName}";
            });
    }

    //Relationships
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class, 'owner_id');
    }
}
