@extends('layouts.app')

@section('content')
    <div style="margin-bottom:50px;">
        <div class="row" style="text-align:center;height:300px;background-color:#1c75bc;color:white;">
            @if ($post->image)
                <img src="{{url('images/'.$post->image)}}" class="img-responsive" alt="Responsive image">
            @endif
        </div>
        <div class="row" style="margin-top:-50px;">
            <div class="col-md-7 col-xs-offset-1" style="background-color:white;padding:20px;">
                <h1 style="text-transform: uppercase;">{{$post->title}}</h1>
                <p class="small" style="font-style: italic;">Posted: {{$post->startdatetime->format('F dS Y')}}</p>
                <p>{!!nl2br($post->body)!!}</p>
            </div>
            <div class="col-md-3">
                <div class="sidebar-module sidebar-module-inset" style="background-color:white;padding: 10px;">
                    @foreach ($post->tags as $tag)
                        <a href="{{url('tags/'.$tag->slug)}}">{{$tag->title}}</a><br>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11 col-xs-offset-1">

            </div>
        </div>
    </div>
@endsection
