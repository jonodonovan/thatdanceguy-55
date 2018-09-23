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
            <p><a href="https://www.google.com/maps/place/{{$venue->address}} {{$venue->city}}, FL {{$venue->zip}}" target="_blank">{{$venue->address}} {{$venue->city}}, FL {{$venue->zip}} <i class="fa fa-map-marker" aria-hidden="true"></i></a> 
                @if($venue->phone)
                | {{$venue->phone}}
                @endif
            </p>
        </div>
    </div>
    @if (! $upcomingevents->isEmpty())
        <div class="row">
            <div class="col-md-12">
                @if ($upcomingevents->count() >= 2)
                    <h3>Upcoming Events:</h3>
                @else 
                    <h3>Upcoming Event:</h3>
                @endif
            </div>
        </div>
        <div class="row">
            @foreach ($upcomingevents as $event)
                <div class="col-md-3">
                    <div class="all-events">
                        <a href="{{url('events/'.$event->slug)}}" style="text-decoration:none;">
                        <div class="thumbnail" style="border: 2px solid #000000;">
                            <div class="caption" style="">
                                <h3 style="font-weight:bold;">{{$event->name}}
                                    @if($event->presaleprice || $event->saleprice)
                                        @if($event->presaleend > $today)
                                            <i class="fa fa-ticket" aria-hidden="true">$<b>{{$event->presaleprice/100}}</b></i>
                                        @else
                                            <i class="fa fa-ticket" aria-hidden="true">$<b>{{$event->saleprice/100}}</b></i>
                                        @endif
                                    @endif
                                </h3>
                                <p style="padding:10px 0;"><span style="font-weight:bold;">{{$event->startdatetime->format('F dS')}}</span> 
                                from {{$event->startdatetime->format('ga')}} to {{$event->enddatetime->format('ga')}}</p>
                                <p>{{$event->intro}}</p>
                                @if ($event->address)
                                    <p style="padding-top:10px;">Location: <a href="/venues/{{$event->venue->slug}}">{{$event->venue->name}}</a> in <a href="https://www.google.com/maps/place/{{$event->address}} {{$event->city}}, FL {{$event->zip}}" target="_blank">{{$event->city}}</a></p>
                                @else
                                    <p style="padding-top:10px;">Location: <a href="/venues/{{$event->venue->slug}}">{{$event->venue->name}}</a> in <a href="https://www.google.com/maps/place/{{$event->venue->address}} {{$event->venue->city}}, FL {{$event->venue->zip}}" target="_blank">{{$event->venue->city}}</a></p>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <h3>No Upcoming Events</h3>
            </div>
        </div>
    @endif
</div>
@endsection
