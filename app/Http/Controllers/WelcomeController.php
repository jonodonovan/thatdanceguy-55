<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Event;
use App\Ticket;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function home()
    {
        $today = Carbon::now();
        $posts = Post::orderBy('title')->get();
        $events = Event::where('startdatetime', '>', $today)->orderBy('startdatetime')->get();
        $upcomingevents = Event::where('startdatetime', '>', $today)->orderBy('startdatetime')->get();

        return view('welcome')->withPosts($posts)->withEvents($events)->withUpcomingevents($upcomingevents)->withToday($today);
    }

    public function thankyou($slug)
    {
        $ticket = Ticket::where('slug', '=', $slug)->firstOrFail();
        $tickets = Ticket::where('slug', '=', $slug)->get();
        return view('public.pages.thankyou')->withTickets($tickets)->withTicket($ticket);

    }
}
