@extends('layouts.app')

@section('content')
    <div class="container">
        <p><a href="{{route('admin.tag.index')}}"><-Back</a></p>
        <h1 style="text-transform: uppercase;">{{$tag->title}}</h1>
        <p>{{$tag->description}}</p>
    </div>

@endsection
