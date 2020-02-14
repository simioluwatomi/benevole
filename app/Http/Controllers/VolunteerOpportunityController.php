<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VolunteerOpportunity;

class VolunteerOpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View|string
     */
    public function index()
    {
        $opportunities = VolunteerOpportunity::with('owner', 'category')->paginate(12);

        return view('opportunity.index', compact('opportunities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $volunteerOpportunity->load('category', 'owner');

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
