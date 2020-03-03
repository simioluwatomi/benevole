<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VolunteerOpportunity;
use Illuminate\Auth\Access\HandlesAuthorization;

class VolunteerOpportunityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any volunteer opportunities.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
    }

    /**
     * Determine whether the user can view the volunteer opportunity.
     *
     * @param \App\Models\User     $user
     * @param VolunteerOpportunity $volunteerOpportunity
     *
     * @return mixed
     */
    public function view(User $user, VolunteerOpportunity $volunteerOpportunity)
    {
    }

    /**
     * Determine whether the user can create volunteer opportunities.
     *
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role->name === 'organization' && $user->hasVerifiedEmail();
    }

    /**
     * Determine whether the user can update the volunteer opportunity.
     *
     * @param \App\Models\User     $user
     * @param VolunteerOpportunity $volunteerOpportunity
     *
     * @return mixed
     */
    public function update(User $user, VolunteerOpportunity $volunteerOpportunity)
    {
    }

    /**
     * Determine whether the user can delete the volunteer opportunity.
     *
     * @param \App\Models\User     $user
     * @param VolunteerOpportunity $volunteerOpportunity
     *
     * @return mixed
     */
    public function delete(User $user, VolunteerOpportunity $volunteerOpportunity)
    {
    }

    /**
     * Determine whether the user can restore the volunteer opportunity.
     *
     * @param \App\Models\User     $user
     * @param VolunteerOpportunity $volunteerOpportunity
     *
     * @return mixed
     */
    public function restore(User $user, VolunteerOpportunity $volunteerOpportunity)
    {
    }

    /**
     * Determine whether the user can permanently delete the volunteer opportunity.
     *
     * @param \App\Models\User     $user
     * @param VolunteerOpportunity $volunteerOpportunity
     *
     * @return mixed
     */
    public function forceDelete(User $user, VolunteerOpportunity $volunteerOpportunity)
    {
    }
}
