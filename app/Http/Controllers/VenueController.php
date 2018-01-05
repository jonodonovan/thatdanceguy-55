<?php

namespace App\Http\Controllers;

use App\Venue;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class VenueController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['public', 'publicshow']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public()
    {
        $venues = Venue::orderBy('name')->get();
        $today = Carbon::today()->toDateTimeString();
        return view('public.venue.index')->withVenues($venues)->withToday($today);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicshow($slug)
    {
        $today = Carbon::today()->toDateTimeString();
        $venue = Venue::where('slug', '=', $slug)->firstOrFail();
        $upcomingevents = Event::where('venue_id', '=', $venue->id)->where('startdatetime', '>', $today)->orderBy('startdatetime')->get();
        return view('public.venue.show')->withVenue($venue)->withUpcomingevents($upcomingevents);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::orderBy('name')->get();

        return view('admin.venue.index')->withVenues($venues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.venue.create');
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
            'phone' => '',
            'address' => '',
            'city' => 'required',
            'zip' => '',
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
        $venue->phone = $request->phone;
        $venue->address = $request->address;
        $venue->city = $request->city;
        $venue->zip = $request->zip;
        $venue->facebook = $request->facebook;
        $venue->lat = $request->lat;
        $venue->lng = $request->lng;

        $venue->save();

        Session::flash('success', 'New Venue Created');

        // redirect
        return redirect()->route('admin.venue.index');
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

        return view('admin.venue.show')->withVenue($venue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $venue = Venue::where('slug', '=', $slug)->firstOrFail();

        return view('admin.venue.edit')->withVenue($venue);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $venue = Venue::where('slug', '=', $slug)->firstOrFail();

        $this->validate($request, array(
            'name' => 'required|max:255',
            'phone' => '',
            'address' => '',
            'city' => 'required',
            'zip' => '',
            'facebook' => '',
            'lat' => '',
            'lng' => '',
        ));

        $venue->slug = $request->name;
        $delimiter = '-';
        $venue->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $venue->slug);
        $venue->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $venue->slug);
        $venue->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $venue->slug);
        $venue->slug = strtolower(trim($venue->slug, $delimiter));

        $venue->name = $request->name;
        $venue->phone = $request->phone;
        $venue->address = $request->address;
        $venue->city = $request->city;
        $venue->zip = $request->zip;
        $venue->facebook = $request->facebook;
        $venue->lat = $request->lat;
        $venue->lng = $request->lng;

        $venue->save();

        Session::flash('success', 'Venue Updated');

        return redirect()->route('admin.venue.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venue = Venue::findorFail($id);
        $venue->delete();

        Session::flash('success', 'Venue Deleted');
        return redirect()->route('admin.venue.index');
    }
}
