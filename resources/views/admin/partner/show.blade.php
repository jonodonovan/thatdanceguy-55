@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row">
            <a href="{{route('admin.venue.index')}}"><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a> Admin
            <div class="col-md-12">
                <h1>{{$partner->name}}</h1>
                <p>{{$partner->intro}}</p>
            </div>
        </div>
    </div>
@endsection
