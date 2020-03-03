<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\VolunteerOpportunity;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::withCount('opportunities')->get();

        $opportunities = VolunteerOpportunity::with(['owner.organization' => function ($query) {
            $query->select(['id', 'organization_id', 'organization_name']);
        }, 'category'])->latest()->limit(6)->get();

        return view('index', compact('opportunities', 'categories'));
    }
}
