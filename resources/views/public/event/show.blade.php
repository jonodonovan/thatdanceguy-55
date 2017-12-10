@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$event->name}}</h1>
            <p style="font-weight:bold;">{{$event->startdatetime->format('F dS')}} from {{$event->startdatetime->format('ga')}} to {{$event->enddatetime->format('ga')}}</p>
            <p style="font-style: italic;">{{$event->intro}}</p>
            <p>{{$event->description}}</p>
            {{-- @foreach ($event->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->title}}</a>
            @endforeach --}}
        </div>
    </div>
</div>
@endsection
