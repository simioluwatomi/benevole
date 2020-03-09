<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Profile.
 *
 * @property int                             $id
 * @property int                             $organization_id
 * @property null|string                     $organization_name
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property \App\Models\User                $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile whereOrganizationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrganizationProfile whereOrganizationId($value)
 *
 * @mixin \Eloquent
 */
class OrganizationProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'organization_id',
        'organization_name',
    ];

    /**
     * A profile belongs to a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'organization_id');
    }
}
