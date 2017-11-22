@extends('layouts.app')

@section('content')
<div class="page-wrapper" style="background-color:white;padding:50px;">
    <form method="POST" action="{{ route('admin.venue.update', $venue->slug) }}">
    {{ method_field('PATCH')}}
    {{ csrf_field() }}
        <div class="row">
            <h1 style="text-transform:uppercase;">Editing {{$venue->name}}</h1>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                    <label for="name" class="control-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$venue->name or old('name')}}" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('facebook') ? ' has-error' : ''}}">
                    <label for="facebook" class="control-label">Facebook URL</label>
                    <input id="facebook" type="text" class="form-control" name="facebook" value="{{$venue->facebook or old('facebook')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('lat') ? ' has-error' : ''}}">
                    <label for="lat" class="control-label">Latitude</label>
                    <input id="lat" type="text" class="form-control" name="lat" value="{{$venue->lat or old('lat')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('lng') ? ' has-error' : ''}}">
                    <label for="lng" class="control-label">Longitude</label>
                    <input id="lng" type="text" class="form-control" name="lng" value="{{$venue->lng or old('lng')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <a class="btn btn-default" href="{{route('admin.post.index')}}">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Venue</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
