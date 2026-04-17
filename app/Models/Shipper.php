<?php

namespace App\Models;

use Spatie\Activitylog\Support\LogOptions;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activitiesAsSubject
 * @property-read int|null $activities_as_subject_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bill> $bills
 * @property-read int|null $bills_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper permission($permissions, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper role($roles, ?string $guard = null, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper withoutRole($roles, ?string $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shipper withoutTrashed()
 * @mixin \Eloquent
 */
class Shipper extends User
{
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['email', 'name', 'phone', 'gender', 'birthday', 'status'])
            ->logOnlyDirty()
            ->useLogName('user_management')
            ->setDescriptionForEvent(function (string $eventName) {
                return "Shipper account has been {$eventName}";
            });
    }


    //Relationships
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
