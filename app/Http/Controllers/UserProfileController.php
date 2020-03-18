<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
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
        $user->load('profile');

        $countries = $service->filterCountriesByParameter('name');

        return view('user.volunteer', compact('user', 'countries'));
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

        UserProfile::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'first_name'        => $validated['first_name'],
                'last_name'         => $validated['last_name'],
                'country'           => $validated['country'],
                'bio'               => $validated['bio'],
                'twitter_username'  => $validated['twitter_username'],
                'linkedin_username' => $validated['linkedin_username'],
            ]
        );

        if ($user->wasChanged('email')) {
            $user->update(['email_verified_at' => null]);
            $user->sendEmailVerificationNotification();
        }

        return redirect()->route('volunteer.show', $user)->with('message', [
            'type'  => 'success',
            'body'  => 'Profile update successful!',
        ]);
    }
}
