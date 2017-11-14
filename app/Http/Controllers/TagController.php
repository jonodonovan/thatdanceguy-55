<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::orderBy('title')->get();

        return view('tags.index')->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
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
            'title' => 'required|max:255|unique:tags,title',
            'description' => '',
        ));

        // store data
        $tag = new Tag;

        $tag->slug = $request->title;
        $delimiter = '-';
        $tag->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $tag->slug);
        $tag->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $tag->slug);
        $tag->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $tag->slug);
        $tag->slug = strtolower(trim($tag->slug, $delimiter));

        $tag->title = $request->title;
        $tag->description = $request->description;

        $tag->save();

        Session::flash('success', 'New Tag Created');

        // redirect
        return redirect()->route('tags.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', '=', $slug)->firstOrFail();

        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tag = Tag::where('slug', '=', $slug)->firstOrFail();

        return view('tags.edit')->withTag($tag);
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

        $tag = Tag::where('slug', '=', $slug)->firstOrFail();
        // $tag = Tag::firstOrFail($slug);

        // validate data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'description' => 'required'
        ));

        $tag->title = $request->title;
        $tag->description = $request->description;

        $tag->save();

        Session::flash('success', 'Tag Updated');

        // redirect
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->events()->detach();

        $tag->delete();

        Session::flash('success', 'Tag deleted');

        return redirect()->route('tags.index');
    }
}
