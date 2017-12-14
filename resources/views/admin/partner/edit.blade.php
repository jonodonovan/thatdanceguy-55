@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/vendor/simplemde.min.css">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 style="text-transform:uppercase;">Editing {{$partner->name}}</h1>
        </div>
    </div>
    <form method="POST" action="{{route('admin.partner.update', $partner->slug)}}">
    {{method_field('PATCH')}}
    {{csrf_field()}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                    <label for="name" class="control-label">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$partner->name or old('name')}}" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('website') ? ' has-error' : ''}}">
                    <label for="website" class="control-label">Website</label>
                    <input id="website" type="text" class="form-control" name="website" value="{{$partner->website or old('website')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('intro') ? ' has-error' : ''}}">
                    <label for="intro" class="control-label">Intro</label>
                    <textarea rows="5" id="intro" class="form-control" name="intro">{{$partner->intro or old('intro')}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{$errors->has('phone') ? ' has-error' : ''}}">
                    <label for="phone" class="control-label">Phone Number</label>
                    <input id="phone" type="text" class="form-control" name="phone" value="{{$partner->phone or old('phone')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('email') ? ' has-error' : ''}}">
                    <label for="email" class="control-label">Email Address</label>
                    <input id="email" type="text" class="form-control" name="email" value="{{$partner->email or old('email')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('specialty') ? ' has-error' : ''}}">
                    <label for="specialty" class="control-label">Specialty</label>
                    <input id="specialty" type="text" class="form-control" name="specialty" value="{{$partner->specialty or old('specialty')}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="btn btn-default" href="{{route('admin.partner.index')}}">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Partner</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script_footer')
    <script src="/vendor/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE();
    </script>
@endsection
