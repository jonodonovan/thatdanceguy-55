@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h2 style="margin-bottom:50px;">Upcoming Events</h2>
        </div>
    </div>
    <div class="row">
        @foreach ($events as $event)
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
