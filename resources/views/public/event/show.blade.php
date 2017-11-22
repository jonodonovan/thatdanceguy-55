@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12" style="background-color:white;padding:50px;">
            <h1>{{$event->name}}</h1>
            <p>Start: {{$event->startdatetime->toDayDateTimeString()}} | End: {{$event->enddatetime->toDayDateTimeString()}}</p>
            @foreach ($event->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->title}}</a>
            @endforeach
        </div>
    </div>
@endsection
