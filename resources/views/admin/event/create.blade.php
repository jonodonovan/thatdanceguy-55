@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <form method="POST" action="{{route('admin.event.store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="row">
            <h1 style="text-transform:uppercase;">Create a new event</h1>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                    <label for="name" class="control-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}"  autofocus>
                </div>
                <div class="form-group">
                    <label for="exampleSelect2">Tag</label>
                    <select multiple class="form-control" id="tagselect" name="tagselect[]">
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect2">Venue</label>
                    <select class="form-control" id="venue_id" name="venue_id">
                        @foreach ($venues as $venue)
                            <option value="{{$venue->id}}">{{$venue->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('intro') ? ' has-error' : ''}}">
                    <label for="intro" class="control-label">Intro</label>
                    <input id="intro" type="text" class="form-control" name="intro" value="{{old('intro')}}" >
                </div>
                <div class="form-group {{$errors->has('description') ? ' has-error' : ''}}">
                    <label for="description" class="control-label">Description</label>
                    <textarea rows="10" id="description" class="form-control" name="description">{{old('description')}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{$errors->has('image') ? ' has-error' : ''}}">
                    <label for="image" class="control-label">Event Image Banner</label><br />
                    <input type="file" id="image" class="form-control" name="image"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="startdate" class="control-label">Start Date & Time</label>
                    <input id="startdatetime" type="text" class="form-control" name="startdatetime">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="enddatetime" class="control-label">End Date & Time</label>
                    <input id="enddatetime" type="text" class="form-control" name="enddatetime">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{$errors->has('facebook') ? ' has-error' : ''}}">
                    <label for="facebook" class="control-label">Facebook Event Link</label>
                    <input id="facebook" type="text" class="form-control" name="facebook" value="{{old('facebook')}}" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('lat') ? ' has-error' : ''}}">
                    <label for="lat" class="control-label">Latitude</label>
                    <input id="lat" type="text" class="form-control" name="lat" value="{{old('lat')}}" >
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{$errors->has('lng') ? ' has-error' : ''}}">
                    <label for="lng" class="control-label">Longitude</label>
                    <input id="lng" type="text" class="form-control" name="lng" value="{{old('lng')}}" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="btn btn-default" href="{{route('admin.event.index')}}">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Event</button>
            </div>
        </div>
    </form>
</div>
@endsection
