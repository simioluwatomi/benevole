<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\VolunteerOpportunity;
use App\Http\Requests\StoreVolunteerOpportunityRequest;

class VolunteerOpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View|string
     */
    public function index()
    {
        $opportunities = VolunteerOpportunity::latest()->with('owner.organization', 'category')->paginate(12);

        return view('opportunity.index', compact('opportunities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', VolunteerOpportunity::class);

        $categories = Category::orderBy('title')->get();

        return view('opportunity.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVolunteerOpportunityRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreVolunteerOpportunityRequest $request)
    {
        auth()->user()->opportunities()->create($request->validated());

        return redirect()->route('opportunity.index')->with('message', [
            'type'  => 'success',
            'body'  => 'Your volunteer opportunity has been posted!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param VolunteerOpportunity $volunteerOpportunity
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show(VolunteerOpportunity $volunteerOpportunity)
    {
        $volunteerOpportunity->load('category', 'owner.organization');

        return view('opportunity.show', compact('volunteerOpportunity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VolunteerOpportunity $volunteerOpportunity
     */
    public function edit(VolunteerOpportunity $volunteerOpportunity)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param VolunteerOpportunity     $volunteerOpportunity
     */
    public function update(Request $request, VolunteerOpportunity $volunteerOpportunity)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VolunteerOpportunity $volunteerOpportunity
     */
    public function destroy(VolunteerOpportunity $volunteerOpportunity)
    {
    }
}
