<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use App\Notifications\PasswordChangeSuccessful;

class UserPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdatePasswordRequest $request
     * @param User                  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdatePasswordRequest $request, User $user)
    {
        $user->update(['password' => Hash::make($request->input('new_password'))]);

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $user->notify(new PasswordChangeSuccessful());

        return redirect(route('login'))->with('message', [
            'type' => 'success',
            'body' => 'Password changed! Log in with your new password.',
        ]);
    }
}
