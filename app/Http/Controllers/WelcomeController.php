<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Event;

class WelcomeController extends Controller
{
    public function home()
    {
        $posts = Post::orderBy('title')->get();
        $events = Event::orderBy('id')->get();
        $upcomingevents = Event::orderBy('startdatetime')->get();
        return view('welcome')->withPosts($posts)->withEvents($events)->withUpcomingevents($upcomingevents);
    }
}
