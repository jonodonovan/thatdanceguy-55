@extends('layouts.app')

@section('content')
<div class="container">
    <p><a href="{{route('admin.event.index')}}"><-Back</a></p>
    @if ($event->image)
        <img src="{{url('images/'.$event->image)}}" class="img-thumbnail" alt="Responsive image">
    @endif

    <h1 style="text-transform: uppercase;">{{$event->name}}</h1>
    <h2>{{$event->intro}}</h2>
    <p>{{$event->description}}</p>
    <p>{{$event->facebook}}</p>

</div>
@endsection
