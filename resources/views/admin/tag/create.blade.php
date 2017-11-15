@extends('layouts.app')

@section('content')

    <div class="container m-b-100">
        <h1 style="text-transform:uppercase;">Create a new Tag</h1>
        <form method="POST" action="{{route('admin.tag.store')}}">
            {{csrf_field()}}
            <div class="form-group {{$errors->has('title') ? ' has-error' : ''}}">
                <label for="title" class="control-label">Title</label>
                <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}" required autofocus>
            </div>

            <div class="form-group {{$errors->has('description') ? ' has-error' : ''}}">
                <label for="description" class="control-label">Description</label>
                <textarea rows="10" id="description" class="form-control" name="description">{{old('description')}}</textarea>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Create Tag</button>
            </div>
        </form>
    </div>

@endsection
