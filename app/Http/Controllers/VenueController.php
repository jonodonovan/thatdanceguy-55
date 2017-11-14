<?php

namespace App\Http\Controllers;

use App\Venue;
use Illuminate\Http\Request;
use Session;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::orderBy('name')->get();

        return view('venues.index')->withVenues($venues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('venues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:255|unique:venues,name',
            'facebook' => '',
            'lat' => '',
            'lng' => '',
        ));

        $venue = new Venue;

        $venue->slug = $request->name;
        $delimiter = '-';
        $venue->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $venue->slug);
        $venue->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $venue->slug);
        $venue->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $venue->slug);
        $venue->slug = strtolower(trim($venue->slug, $delimiter));

        $venue->name = $request->name;
        $venue->facebook = $request->facebook;
        $venue->lat = $request->lat;
        $venue->lng = $request->lng;

        $venue->save();

        Session::flash('success', 'New Venue Created');

        // redirect
        return redirect()->route('venues.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $venue = Venue::where('slug', '=', $slug)->firstOrFail();

        return view('venues.show')->withVenue($venue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        //
    }
}
