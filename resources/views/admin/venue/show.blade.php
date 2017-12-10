@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <a href="{{route('admin.venue.index')}}"><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a> Admin
        <div class="col-md-12">
            <h1>{{$venue->name}}

                @if ($venue->facebook)
                    <a href="{{$venue->facebook}}" target="_blank">
                        <i class="fa fa-facebook-official pull-right" aria-hidden="true"></i>
                    </a>
                @endif
            </h1>

            <p>{{$venue->address}} {{$venue->city}}, FL {{$venue->zip}} | {{$venue->phone}}</p>
            <h3>Upcoming Events:</h3>
            @foreach ($venue->events as $event)
                <a href="/events/{{$event->slug}}">{{$event->name}}</a>
            @endforeach


        </div>
    </div>
</div>
@endsection
