<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('title')->get();
        $tags = Tag::all()->unique('title');

        return view('posts.index')->withPosts($posts)->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alltags = Tag::orderBy('title')->get();
        return view('posts.create')->withAlltags($alltags);
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
            'title' => 'required|max:255|unique:posts,title',
            'intro' => '',
            'body' => '',
            'image' => 'image|mimes:jpeg,bmp,png',

        ));

        // store data
        $post = new Post;

        $post->slug = $request->title;
        $delimiter = '-';
        $post->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $post->slug);
        $post->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $post->slug);
        $post->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $post->slug);
        $post->slug = strtolower(trim($post->slug, $delimiter));

        $post->title = $request->title;
        $post->intro = $request->intro;
        $post->body = $request->body;
        $post->image = $request->image;
        $post->startdatetime = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->startdatetime)));
        $post->enddatetime = date('Y-m-d H:i:s',strtotime('+00 seconds',strtotime($request->enddatetime)));

        if ($request->image)
        {
            $imagename = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imagename);
            $post->image = $imagename;
        }

        $post->save();

        if (isset($request->tagselect))
        {
            $post->tags()->sync($request->tagselect);
        } else {
            $post->tags()->sync(array());
        }

        Session::flash('success', 'New Post Created');

        return redirect()->route('posts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        $alltags = Tag::orderBy('title')->get();

        $tags = $post->tags->modelKeys();
        $similarthings = Post::whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('tags.id', $tags);
        })->where('id', '<>', $post->id)->orderBy('id', 'asc')->get();

        $similarthings_name = Post::where('title', '=', $post->title)->where('id', '<>', $post->id)->get();

        return view('posts.show')->withPost($post)->withTag($alltags)->withSimilarthings($similarthings)->withSimilarthings_name($similarthings_name);
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
        //
    }
}
