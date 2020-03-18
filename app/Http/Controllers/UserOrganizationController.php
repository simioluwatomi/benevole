<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class UserOrganizationController extends Controller
{
    public function show(User $user)
    {
        $user->load('organization');

        $client = new Client([
            'base_uri' => 'https://restcountries.eu/rest/v2/all',
        ]);

        $countries = null;

        if (auth()->user() && auth()->user()->can('update', $user)) {
            $countries = Cache::remember('countries', 60 * 60 * 24 * 30, function () use ($client) {
                $response = $client->get('?fields=name');

                return json_decode($response->getBody());
            });
        }

        return view('user.organization', compact('user', 'countries'));
    }
}
