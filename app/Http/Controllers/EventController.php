<?php

namespace App\Http\Controllers;

use App\Event;
use App\Tag;
use App\Venue;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

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
        $today = Carbon::today()->toDateTimeString();
        $events = Event::where('startdatetime', '>', $today)->orderBy('startdatetime')->get();
        $tags = Tag::all()->unique('name');

        return view('public.event.index')->withEvents($events)->withTags($tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicshow($slug)
    {
        $now = Carbon::today()->toDateTimeString();
        $event = Event::where('slug', '=', $slug)->firstOrFail();
        $tags = Tag::all()->unique('name');

        return view('public.event.show')->withEvent($event)->withTags($tags)->withNow($now);
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
        $venues = Venue::all();

        return view('admin.event.index')->withEvents($events)->withTags($tags)->withVenues($venues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('title')->get();
        $venues = Venue::orderBy('name')->get();

        return view('admin.event.create')->withTags($tags)->withVenues($venues);
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
            'name'          => 'required|max:255|unique:events,name',
            'intro'         => 'nullable|max:255',
            'description'   => 'nullable',
            'image'         => 'image|mimes:jpeg,bmp,png',
            'startdatetime' => 'nullable',
            'enddatetime'   => 'nullable',
            'facebook'      => 'nullable|max:255',
            'address'       => 'nullable|max:255',
            'city'          => 'nullable|max:255',
            'zip'           => 'nullable|max:255',
            'venue_id'      => 'required|integer',
            'presalenote'   => 'nullable|max:255',
            'salenote'      => 'nullable|max:255'
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
        $event->presalestart = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->presalestart)));
        $event->presaleend = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->presaleend)));
        $event->presaleprice = $request->presaleprice;
        $event->presalenote = $request->presalenote;
        $event->salestart = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->salestart)));
        $event->saleend = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->saleend)));
        $event->saleprice = $request->saleprice;
        $event->salenote = $request->salenote;
        $event->facebook = $request->facebook;
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

        return redirect()->route('admin.event.index');
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
        $venues = Venue::orderBy('name')->get();

        return view('admin.event.edit')->withEvent($event)->withTags($tags)->withVenues($venues);
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
            'name'          => 'required|max:255',
            'intro'         => 'nullable|max:255',
            'description'   => 'nullable',
            'image'         => 'image|mimes:jpeg,bmp,png',
            'startdatetime' => 'nullable',
            'enddatetime'   => 'nullable',
            'facebook'      => 'nullable|max:255',
            'address'       => 'nullable|max:255',
            'city'          => 'nullable|max:255',
            'zip'           => 'nullable|max:255',
            'venue_id'      => 'integer',
            'presalenote'   => 'nullable|max:255',
            'salenote'      => 'nullable|max:255'
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
        $event->startdatetime = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->startdatetime)));
        $event->enddatetime = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->enddatetime)));
        $event->presalestart = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->presalestart)));
        $event->presaleend = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->presaleend)));
        $event->presaleprice = $request->presaleprice;
        $event->presalenote = $request->presalenote;
        $event->salestart = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->salestart)));
        $event->saleend = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->saleend)));
        $event->saleprice = $request->saleprice;
        $event->salenote = $request->salenote;
        $event->facebook = $request->facebook;
        $event->venue_id = $request->venue_id;

        if ($request->image != NULL)
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

        return redirect()->route('admin.event.index');
    }
}
