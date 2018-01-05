@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            @if ($event->image)
                <img src="/images/{{$event->image}}" class="img-responsive" alt="Responsive image">
            @endif
            <h1 style="text-transform:uppercase;font-weight:bold;">{{$event->name}}</h1>
            <p style="text-transform:uppercase;font-weight:bold;">{{$event->startdatetime->format('F dS')}} from {{$event->startdatetime->format('ga')}} to {{$event->enddatetime->format('ga')}}</p>
            <p>Location: <a href="https://www.google.com/maps/place/{{$event->address}} {{$event->city}}, FL {{$event->zip}}" target="_blank">{{$event->address}} {{$event->city}}, FL {{$event->zip}} <i class="fa fa-map-marker" aria-hidden="true"></i></a></p>
            <p style="font-style: italic;">{{$event->intro}}</p>
            <p>{!!Markdown::convertToHtml($event->description)!!}</p>
            <p>Presented by: <a href="/venues/{{$event->venue->slug}}">{{$event->venue->name}}</a></p>
            {{-- @foreach ($event->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->title}}</a>
            @endforeach --}}
        </div>
    </div>
</div>
@endsection
