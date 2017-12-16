@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$venue->name}}
                @if ($venue->facebook)
                    <a href="{{$venue->facebook}}" target="_blank">
                        <i class="fa fa-facebook-official pull-right" aria-hidden="true"></i>
                    </a>
                @endif
            </h1>
            <p><a href="https://www.google.com/maps/place/{{$venue->address}} {{$venue->city}}, FL {{$venue->zip}}" target="_blank">{{$venue->address}} {{$venue->city}}, FL {{$venue->zip}} <i class="fa fa-map-marker" aria-hidden="true"></i></a> | {{$venue->phone}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Upcoming Events:</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($venue->events as $event)
            <div class="col-md-3">
                <div class="all-events">
                    <a href="{{url('events/'.$event->slug)}}" style="text-decoration:none;">
                    <div class="thumbnail" style="border: 2px solid #000000;">
                        <div class="caption" style="">
                            <h3 style="font-weight:bold;">{{$event->name}}</h3>
                            <p>{{$event->intro}}</p>
                            <p style="font-weight:bold;">{{$event->startdatetime->format('F dS')}}</p>
                            <p>{{$event->startdatetime->format('ga')}} - {{$event->enddatetime->format('ga')}}</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
