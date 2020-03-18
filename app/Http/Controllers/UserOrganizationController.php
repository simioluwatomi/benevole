<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RestCountriesService;

class UserOrganizationController extends Controller
{
    public function show(User $user, RestCountriesService $service)
    {
        $user->load('organization');

        $countries = $service->filterCountriesByParameter('name');

        return view('user.organization', compact('user', 'countries'));
    }
}
