<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Models\VolunteerOpportunity.
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property int                             $category_id
 * @property string                          $title
 * @property string                          $description
 * @property string                          $slug
 * @property int                             $min_hours_per_week
 * @property int                             $max_hours_per_week
 * @property int                             $duration
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property \App\Models\Category            $category
 * @property \App\Models\User                $owner
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereMaxHoursPerWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereMinHoursPerWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereUserId($value)
 * @mixin \Eloquent
 */
class VolunteerOpportunity extends Model
{
    use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'slug',
        'min_hours_per_week',
        'max_hours_per_week',
        'duration',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * A volunteer opportunity is created by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A volunteer opportunity belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * {@inheritdoc}
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
