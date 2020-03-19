<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RestCountriesService;
use App\Http\Requests\UpdateUserProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User                 $user
     * @param RestCountriesService $service
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user, RestCountriesService $service)
    {
        $user->load('profile', 'role');

        $countries = $service->filterCountriesByParameter('name');

        if ($user->role->name == 'volunteer') {
            return view('user.volunteer', compact('user', 'countries'));
        }

        return view('user.organization', compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserProfileRequest $request
     * @param User                     $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserProfileRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update([
            'username' => $validated['username'],
            'email'    => $validated['email'],
        ]);

        $user->profile->update([
            'first_name'        => $validated['first_name'] ?? null,
            'last_name'         => $validated['last_name'] ?? null,
            'organization_name' => $validated['organization_name'] ?? null,
            'bio'               => $validated['bio'] ?? null,
            'twitter_username'  => $validated['twitter_username'] ?? null,
            'linkedin_username' => $validated['linkedin_username'] ?? null,
            'country'           => $validated['country'] ?? null,
            'website'           => $validated['website'] ?? null,
        ]);

        if ($user->wasChanged('email')) {
            $user->update(['email_verified_at' => null]);
            $user->sendEmailVerificationNotification();
        }

        $intended = $user->role->name == 'volunteer' ? 'volunteer.show' : 'organization.show';

        return redirect()->route($intended, $user)->with('message', [
            'type'  => 'success',
            'body'  => 'Profile update successful!',
        ]);
    }
}
