@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-transform:uppercase;">Editing {{$tag->title}}</h1>
    <form method="POST" action="{{ route('admin.tag.update', $tag->slug) }}">
        {{ method_field('PATCH')}}
        {{ csrf_field() }}
        <div class="form-group {{$errors->has('title') ? ' has-error' : ''}}">
            <label for="title" class="control-label">Title</label>
            <input id="title" type="text" class="form-control" name="title" value="{{$tag->title or old('title')}}" required autofocus>
        </div>

        <div class="form-group {{$errors->has('description') ? ' has-error' : ''}}">
            <label for="description" class="control-label">Description</label>
            <textarea rows="10" id="description" class="form-control" name="description">{{$tag->description or old('description')}}</textarea>
        </div>

        <div class="col-md-12 text-center">
            <a class="btn btn-default" href="{{route('admin.post.index')}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Tag</button>
        </div>
    </form>
</div>
@endsection
