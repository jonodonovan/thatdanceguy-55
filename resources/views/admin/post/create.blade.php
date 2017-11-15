@extends('layouts.app')

@section('content')
    <div class="container m-b-100">
        <h1 style="text-transform:uppercase;">Create a new post</h1>
        <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('Title') ? ' has-error' : '' }}">
                        <label for="title" class="control-label">Post Title</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect2">Tag</label>
                        <select multiple class="form-control" id="tagselect" name="tagselect[]">
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{ $tag->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('intro') ? ' has-error' : '' }}">
                        <label for="intro" class="control-label">Intro</label>

                        <input id="intro" type="text" class="form-control" name="intro" value="{{ old('intro') }}" >

                        @if ($errors->has('intro'))
                            <span class="help-block">
                                <strong>{{ $errors->first('intro') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                        <label for="body" class="control-label">Body</label>

                        <textarea rows="10" id="body" class="form-control" name="body" value="{{ old('body') }}"></textarea>

                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row  m-b-40">
                <div class="col-md-4">

                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="control-label">Post Image Banner</label><br />
                        <input type="file" id="image" class="form-control" name="image"/>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="startdate" class="control-label">Post Add Date & Time</label>
                        <input id="startdatetime" type="text" class="form-control" name="startdatetime">
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="form-group">
                        <label for="enddatetime" class="control-label">Post Remove Date & Time</label>
                        <input id="enddatetime" type="text" class="form-control" name="enddatetime">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </div>
            </div>
        </form>
    </div>
@endsection
