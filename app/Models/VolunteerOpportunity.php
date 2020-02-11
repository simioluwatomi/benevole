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
 * @property int                             $hours_per_week
 * @property \Illuminate\Support\Carbon      $start_date
 * @property \Illuminate\Support\Carbon      $end_date
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereHoursPerWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VolunteerOpportunity whereStartDate($value)
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
        'hours_per_week',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

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
