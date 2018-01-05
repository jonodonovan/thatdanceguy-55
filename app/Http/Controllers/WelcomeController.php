<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Event;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function home()
    {
        $today = Carbon::today()->toDateTimeString();

        $posts = Post::orderBy('title')->get();
        $events = Event::where('startdatetime', '>', $today)->orderBy('startdatetime')->get();
        $upcomingevents = Event::where('startdatetime', '>', $today)->orderBy('startdatetime')->get();

        return view('welcome')->withPosts($posts)->withEvents($events)->withUpcomingevents($upcomingevents);
    }
}
