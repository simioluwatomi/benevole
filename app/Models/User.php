<?php

namespace App\Models;

use App\Notifications\VerifyEmailQueued;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User.
 *
 * @property int                                                                                                       $id
 * @property int                                                                                                       $role_id
 * @property string                                                                                                    $username
 * @property string                                                                                                    $email
 * @property null|\Illuminate\Support\Carbon                                                                           $email_verified_at
 * @property string                                                                                                    $avatar
 * @property string                                                                                                    $password
 * @property null|string                                                                                               $remember_token
 * @property null|\Illuminate\Support\Carbon                                                                           $created_at
 * @property null|\Illuminate\Support\Carbon                                                                           $updated_at
 * @property string                                                                                                    $avatar_url
 * @property \Illuminate\Notifications\DatabaseNotification[]|\Illuminate\Notifications\DatabaseNotificationCollection $notifications
 * @property null|int                                                                                                  $notifications_count
 * @property \App\Models\VolunteerOpportunity[]|\Illuminate\Database\Eloquent\Collection                               $opportunities
 * @property null|int                                                                                                  $opportunities_count
 * @property \App\Models\OrganizationProfile                                                                           $organization
 * @property \App\Models\UserProfile                                                                                   $profile
 * @property \App\Models\Role                                                                                          $role
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'username',
        'email',
        'password',
        'email_verified_at',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at'     => 'datetime',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get the user's avatar url.
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        return asset("storage/{$this->avatar}");
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued());
    }

    /**
     * Get the role of a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * A User has a profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /**
     * A User has an organization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization()
    {
        return $this->hasOne(OrganizationProfile::class, 'organization_id');
    }

    /**
     * A user creates many volunteer opportunities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function opportunities()
    {
        return $this->hasMany(VolunteerOpportunity::class);
    }
}
