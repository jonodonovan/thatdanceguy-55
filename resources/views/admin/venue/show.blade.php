@extends('layouts.app')

@section('content')
<div class="container">
    <p><a href="{{route('admin.venue.index')}}"><-Back</a></p>
    <h1 style="text-transform: uppercase;">{{$venue->name}}</h1>
    <p>{{$venue->facebook}}</p>
    <p>{{$venue->lat}}</p>
    <p>{{$venue->lng}}</p>
</div>
@endsection
