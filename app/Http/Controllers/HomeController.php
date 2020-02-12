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
        $opportunities = VolunteerOpportunity::with('owner', 'category')->latest()->take(6)->get();
        $categories = Category::withCount('opportunities')->get();

        return view('index', compact('opportunities', 'categories'));
    }
}
