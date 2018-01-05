@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>Search by Venue</h1>
        </div>
    </div>
    <div class="row">
        @foreach ($venues as $venue)
            <div class="col-md-3">
                <div class="all-events">
                    <a href="{{url('venues/'.$venue->slug)}}" style="text-decoration:none;">
                    <div class="thumbnail" style="border: 2px solid #000000;">
                        <div class="caption" style="">
                            <h3 style="font-weight:bold;">{{$venue->name}}</h3>
                            <p>Upcoming Events: <span class="label @if($venue->events->count() >= 1) label-success @else label-default @endif">{{$venue->events->where('startdatetime', '>', $today)->count()}}</span></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
