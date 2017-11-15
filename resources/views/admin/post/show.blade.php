@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="{{route('admin.post.index')}}"><-Back</a></p>
        @if ($post->image)
            <img src="{{url('images/'.$post->image)}}" class="img-thumbnail" alt="Responsive image">
        @endif

        <h1 style="text-transform: uppercase;">{{$post->title}}</h1>
        {{-- <span class="badge badge-secondary">Start: {{$post->startdatetime->toDayDateTimeString()}}</span> <span class="badge badge-secondary">End: {{$post->enddatetime->toDayDateTimeString()}}</span><br> --}}
        <p>{!!nl2br($post->body)!!}</p>

        @foreach ($post->tags as $tag)
            <a href="{{url('tags/'.$tag->slug)}}" class="badge badge-info">{{$tag->title}}</a>
        @endforeach

        <br /><br>

        @if (count($similarthings) > 0)
            <h2>Similar Posts</h2>
            @foreach ($similarthings as $sthing)
                <p>{{$sthing->name}}</p>
            @endforeach
        @endif
    </div>

@endsection
