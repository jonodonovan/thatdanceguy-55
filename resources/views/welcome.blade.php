@extends('layouts.app')

@section('content')
    <div class="row" style="padding:15px;">
        <div class="col-md-12" style="padding-right:0px;padding-left:0px;">
            @if ($events->count() >= 2)
                <h3 style="color:white;text-transform:uppercase;">Upcoming Events</h3>
            @else 
                <h3 style="color:white;text-transform:uppercase;">Upcoming Event</h3>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach ($events as $event)
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="thumbnail">
                    <div class="caption" style="text-align:left;">
                        <h3 style="font-weight:bold;">
                            <a href="{{url('events/'.$event->slug)}}" style="text-decoration:none;">{{$event->name}}
                                @if($event->presaleprice || $event->saleprice)
                                    @if($event->presaleend > $today)
                                        <i class="fa fa-ticket" aria-hidden="true">$<b>{{$event->presaleprice/100}}</b></i>
                                    @else
                                        <i class="fa fa-ticket" aria-hidden="true">$<b>{{$event->saleprice/100}}</b></i>
                                    @endif
                                @endif
                            </a>
                        </h3>
                        <p style="padding:10px 0;"><span style="font-weight:bold;">{{$event->startdatetime->format('F dS')}}</span> from {{$event->startdatetime->format('ga')}} to {{$event->enddatetime->format('ga')}}</p>
                        <p>{{$event->intro}}</p>
                        @if ($event->address)
                            <p style="padding-top:10px;">Location: <a href="/venues/{{$event->venue->slug}}">{{$event->venue->name}}</a> in <a href="https://www.google.com/maps/place/{{$event->address}} {{$event->city}}, FL {{$event->zip}}" target="_blank">{{$event->city}}</a></p>
                        @else
                            <p style="padding-top:10px;">Location: <a href="/venues/{{$event->venue->slug}}">{{$event->venue->name}}</a> in <a href="https://www.google.com/maps/place/{{$event->venue->address}} {{$event->venue->city}}, FL {{$event->venue->zip}}" target="_blank">{{$event->venue->city}}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (! $posts->isEmpty())
        <div class="row" style="padding:15px;">
            <div class="col-md-12" style="padding-right:0px;padding-left:0px;">
                <h3 style="color:white;text-transform:uppercase;">Latest Posts</h3>
            </div>
        </div>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-3" style="padding:0 5px;">
                    <div class="thumbnail">
                        @if ($post->image)
                            <img src="{{url('images/'.$post->image)}}" class="" alt="{{$post->title}} image">
                        @endif
                        <div class="caption">
                            <h3 style="font-size:26px;font-weight:bold;text-transform:uppercase;">{{$post->title}}</h3>
                            <p>{{$post->intro}}</p>
                            <p>
                                <a href="{{url('posts/'.$post->slug)}}" class="btn btn-primary" role="button">Read More</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection