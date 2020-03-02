<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UpdateUserProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $user->load('profile');

        $client = new Client([
            'base_uri' => 'https://restcountries.eu/rest/v2/all',
        ]);

        if (auth()->user() && auth()->user()->can('update', $user)) {
            $countries = Cache::remember('countries', 60 * 60 * 24 * 30, function () use ($client) {
                $response = $client->get('?fields=name');

                return json_decode($response->getBody());
            });
        }

        return view('user.show', compact('user', 'countries'));
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

        return redirect()->route('user.show', $user)->with('message', [
            'type'  => 'success',
            'body'  => 'Profile update successful!',
        ]);
    }
}
