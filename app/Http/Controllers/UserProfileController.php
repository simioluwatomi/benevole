<?php

namespace App\Http\Controllers;

use App\Models\User;

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

        return view('user.show', compact('user'));
    }
}
