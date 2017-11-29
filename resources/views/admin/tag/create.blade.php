@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <form method="POST" action="{{route('admin.tag.store')}}">
    {{csrf_field()}}
        <div class="row">
            <h1 style="text-transform:uppercase;">Create a new Tag</h1>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('title') ? ' has-error' : ''}}">
                    <label for="title" class="control-label">Title</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}" required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('description') ? ' has-error' : ''}}">
                    <label for="description" class="control-label">Description</label>
                    <textarea rows="5" id="description" class="form-control" name="description">{{old('description')}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <a class="btn btn-default" href="{{route('admin.tag.index')}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Create Tag</button>
        </div>
    </form>
</div>
@endsection
