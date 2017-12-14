@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 style="text-transform:uppercase;">Editing {{$venue->name}}</h1>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.venue.update', $venue->slug) }}">
    {{ method_field('PATCH')}}
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                    <label for="name" class="control-label">Business Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$venue->name or old('name')}}" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('phone') ? ' has-error' : ''}}">
                    <label for="phone" class="control-label">Phone Number</label>
                    <input id="phone" type="text" class="form-control" name="phone" value="{{$venue->phone or old('phone')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('address') ? ' has-error' : ''}}">
                    <label for="address" class="control-label">Address (Street)</label>
                    <input id="address" type="text" class="form-control" name="address" value="{{$venue->address or old('address')}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('city') ? ' has-error' : ''}}">
                    <label for="city" class="control-label">City</label>
                    <input id="city" type="text" class="form-control" name="city" value="{{$venue->city or old('city')}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group {{$errors->has('zip') ? ' has-error' : ''}}">
                    <label for="zip" class="control-label">Zip</label>
                    <input id="zip" type="text" class="form-control" name="zip" value="{{$venue->zip or old('zip')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('facebook') ? ' has-error' : ''}}">
                    <label for="facebook" class="control-label">Facebook URL</label>
                    <input id="facebook" type="text" class="form-control" name="facebook" value="{{$venue->facebook or old('facebook')}}">
                </div>
            </div>
            <div class="col-md-6">

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
            <div class="col-md-12 text-center">
                <a class="btn btn-default" href="{{route('admin.venue.index')}}">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Venue</button>
            </div>
        </div>
    </form>
</div>
@endsection
