@extends('layouts.app')

@section('content')
<div class="container">
    <p><a href="{{route('admin.venue.index')}}"><-Back</a></p>
    <h1 style="text-transform: uppercase;">{{$venue->name}}</h1>
    <p>{{$venue->facebook}}</p>
    <p>{{$venue->lat}}</p>
    <p>{{$venue->lng}}</p>
    <ul>
        @foreach ($venue->events as $event)
            <li><a href="{{url('admin/event/'.$event->slug)}}">{{$event->name}}</a></li>
        @endforeach
    </ul>
</div>
@endsection
