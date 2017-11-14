<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tag;
use Illuminate\Http\Request;
use Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('name')->get();
        $tags = Tag::all()->unique('title');

        return view('events.index')->withEvents($events)->withTags($tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming()
    {
        $events = Event::orderBy('startdatetime')->get();
        $tags = Tag::all()->unique('title');

        return view('events.upcoming')->withEvents($events)->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alltags = Tag::orderBy('title')->get();
        // dd($alltags);
        return view('events.create')->withAlltags($alltags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate data
        $this->validate($request, array(
            'name' => 'required|max:255|unique:events,name',
            'intro' => '',
            'description' => '',
            'image' => 'image|mimes:jpeg,bmp,png',
            'startdatetime' => '',
            'enddatetime' => '',
            'facebook' => '',
            'lat' => '',
            'lng' => '',
            'venue_id' => 'integer',
        ));

        // store data
        $event = new Event;

        $event->slug = $request->name;
        $delimiter = '-';
        $event->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $event->slug);
        $event->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $event->slug);
        $event->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $event->slug);
        $event->slug = strtolower(trim($event->slug, $delimiter));

        $event->name = $request->name;
        $event->intro = $request->intro;
        $event->description = $request->description;
        $event->image = $request->image;
        $event->startdatetime = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->startdatetime)));
        $event->enddatetime = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->enddatetime)));
        $event->facebook = $request->facebook;
        $event->lat = $request->lat;
        $event->lng = $request->lng;
        $event->venue_id = $request->venue_id;

        if ($request->image)
        {
            $imagename = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imagename);
            $event->image = $imagename;
        }

        $event->save();

        if (isset($request->tagselect))
        {
            $event->tags()->sync($request->tagselect);
        } else {
            $event->tags()->sync(array());
        }



        Session::flash('success', 'New Event Created');

        // redirect
        return redirect()->route('events.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $event = Event::where('slug', '=', $slug)->firstOrFail();
        $alltags = Tag::orderBy('title')->get();

        $tags = $event->tags->modelKeys();
        $similarthings = Event::whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('tags.id', $tags);
        })->where('id', '<>', $event->id)->orderBy('id', 'asc')->get();

        $similarthings_name = Event::where('name', '=', $event->name)->where('id', '<>', $event->id)->get();

        return view('events.show')->withEvent($event)->withTag($alltags)->withSimilarthings($similarthings)->withSimilarthings_name($similarthings_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->tags()->detach();

        $event->delete();

        Session::flash('success', 'Event deleted');

        return redirect()->route('events.index');
    }
}
