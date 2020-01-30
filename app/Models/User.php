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
 * @property null|string                                                                                               $telephone
 * @property null|\Illuminate\Support\Carbon                                                                           $email_verified_at
 * @property null|\Illuminate\Support\Carbon                                                                           $telephone_verified_at
 * @property string                                                                                                    $password
 * @property null|string                                                                                               $remember_token
 * @property null|\Illuminate\Support\Carbon                                                                           $created_at
 * @property null|\Illuminate\Support\Carbon                                                                           $updated_at
 * @property \Illuminate\Notifications\DatabaseNotification[]|\Illuminate\Notifications\DatabaseNotificationCollection $notifications
 * @property null|int                                                                                                  $notifications_count
 * @property \App\Models\Role                                                                                          $role
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTelephoneVerifiedAt($value)
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
        'telephone',
        'password',
        'email_verified_at',
        'telephone_verified_at',
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
        'telephone_verified_at' => 'datetime',
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued);
    }

    /**
     * Get the role of this user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
