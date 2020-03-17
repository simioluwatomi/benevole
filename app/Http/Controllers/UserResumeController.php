<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserResumeController extends Controller
{
    public function store(Request $request, User $user)
    {
        $request->validate(['resume' => ['required', 'mimes:doc,pdf,docx,zip', 'max:512']], [
            'max' => 'The uploaded document should not be greater than 500 kilobytes.',
        ]);

        $document = $request->file('resume');

        $filename = pathinfo(str_replace([' ', "'"], '_', $document->getClientOriginalName()), PATHINFO_FILENAME);

        $file = "{$filename}.{$document->getClientOriginalExtension()}";

        $path = $document->storeAs("{$user->id}", "{$file}", 'public');

        if (Storage::disk('public')->exists($user->profile->resume)) {
            Storage::disk('public')->delete($user->profile->resume);
        }

        $user->profile->update(['resume' => $path]);

        return response()->json($path);
    }

    public function destroy(User $user)
    {
        if (Storage::disk('public')->exists($user->profile->resume)) {
            Storage::disk('public')->delete($user->profile->resume);
        }

        $user->profile->update(['resume' => null]);

        return response()->json($user);
    }
}
