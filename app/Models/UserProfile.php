<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProfile.
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property string                          $first_name
 * @property string                          $last_name
 * @property string                          $country
 * @property null|string                     $bio
 * @property null|string                     $twitter_username
 * @property null|string                     $linkedin_username
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property string                          $full_name
 * @property string                          $linked_in_profile
 * @property string                          $twitter_profile
 * @property \App\Models\User                $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereLinkedinUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereTwitterUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUserId($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'country',
        'bio',
        'twitter_username',
        'linkedin_username',
        'resume',
    ];

    /**
     * Set the user's first name.
     *
     * @param string $value
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = mb_strtolower($value);
    }

    /**
     * Get the user's first name.
     *
     * @param string $value
     *
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Set the user's last name.
     *
     * @param string $value
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = mb_strtolower($value);
    }

    /**
     * Get the user's last name.
     *
     * @param string $value
     *
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's twitter profile.
     *
     * @return string
     */
    public function getTwitterProfileAttribute()
    {
        return isset($this->twitter_username) ? "https://twitter.com/{$this->twitter_username}" : null;
    }

    /**
     * Get the user's LinkedIn profile.
     *
     * @return string
     */
    public function getLinkedInProfileAttribute()
    {
        return isset($this->linkedin_username) ? "https://www.linkedin.com/in/{$this->linkedin_username}" : null;
    }

    /**
     * Get the user's resume url.
     *
     * @return string
     */
    public function getResumeUrlAttribute()
    {
        return isset($this->resume) ? asset("storage/{$this->resume}") : null;
    }

    /**
     * A profile belongs to a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
