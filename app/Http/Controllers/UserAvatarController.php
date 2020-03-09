<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param User                     $user
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $request->validate(['avatar' => ['required', 'image', 'max:1024']]);

        $path = $request->file('avatar')->storeAs(
            "{$user->id}",
            sha1($user->id).'.jpeg',
            'public'
        );

        $user->update(['avatar' => $path]);

        return response()->json($user);
    }
}
