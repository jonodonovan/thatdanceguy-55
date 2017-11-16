<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tag;
use Illuminate\Http\Request;
use Session;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['public', 'publicshow', 'publicupcoming']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function public()
    {
        $posts = Post::orderBy('title')->get();
        $tags = Tag::all()->unique('title');

        return view('public.post.index')->withPosts($posts)->withTags($tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicshow($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        $alltags = Tag::orderBy('title')->get();

        $tags = $post->tags->modelKeys();
        $similarthings = Post::whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('tags.id', $tags);
        })->where('id', '<>', $post->id)->orderBy('id', 'asc')->get();

        $similarthings_name = Post::where('title', '=', $post->title)->where('id', '<>', $post->id)->get();

        return view('public.post.show')->withPost($post)->withTag($alltags)->withSimilarthings($similarthings)->withSimilarthings_name($similarthings_name);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicupcoming()
    {
        $events = Event::orderBy('startdatetime')->get();
        $tags = Tag::all()->unique('title');

        return view('events.upcoming')->withEvents($events)->withTags($tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('name')->get();
        $tags = Tag::all()->unique('title');

        return view('admin.event.index')->withEvents($events)->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alltags = Tag::orderBy('title')->get();

        return view('admin.event.create')->withAlltags($alltags);
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

        return redirect()->route('admin.event.create');
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

        return view('admin.event.show')->withEvent($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $event = Event::where('slug', '=', $slug)->firstOrFail();
        $tags = Tag::all()->unique('title');

        return view('admin.event.edit')->withEvent($event)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $event = Event::where('slug', '=', $slug)->firstOrFail();

        $this->validate($request, array(
            'name' => 'required|max:255',
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

        Session::flash('success', 'Event Updated');

        return redirect()->route('admin.event.index');
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
