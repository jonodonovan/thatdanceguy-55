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
                            <p>{{$venue->address}} {{$venue->city}}, FL {{$venue->zip}} <i class="fa fa-map-marker" aria-hidden="true"></i> 
                            <br>{{$venue->phone}}</p>

                            @if (! $venue->events->count() == 0)
                                <p>
                                    <span class="label @if($venue->events->count() >= 1) label-success @else label-default @endif" style="background-color:#252525;">
                                        {{$venue->events->where('startdatetime', '>', $today)->count()}} upcoming @if($venue->events->count() >= 2)events @else event @endif
                                    </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
