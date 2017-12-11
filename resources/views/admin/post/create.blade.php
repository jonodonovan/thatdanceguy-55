@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/vendor/simplemde.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
@endsection

@section('script_header')
    <script src="https://unpkg.com/flatpickr"></script>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 style="text-transform:uppercase;">Create a new post</h1>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('Title') ? ' has-error' : '' }}">
                    <label for="title" class="control-label">Post Title</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  required autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('intro') ? ' has-error' : '' }}">
                    <label for="intro" class="control-label">Intro</label>
                    <input id="intro" type="text" class="form-control" name="intro" value="{{ old('intro') }}" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                    <label for="body" class="control-label">Body</label>
                    <textarea rows="10" id="body" class="form-control" name="body" value="{{ old('body') }}"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
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
                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image" class="control-label">Post Image Banner</label><br />
                    <input type="file" id="image" class="form-control" name="image"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="startdate" class="control-label">Post Add Date & Time</label>
                    <input id="startdatetime" type="text" class="form-control" name="startdatetime">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="enddatetime" class="control-label">Post Remove Date & Time</label>
                    <input id="enddatetime" type="text" class="form-control" name="enddatetime">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="btn btn-default" href="{{route('admin.post.index')}}">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script_footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript">
        flatpickr("#startdatetime", {
            altInput: true,
            enableTime: true,
            dateFormat: 'Y-m-d H:i:s'
        });
        flatpickr("#enddatetime", {
            altInput: true,
            enableTime: true,
            dateFormat: 'Y-m-d H:i:s'
        });
    </script>

    <script src="/vendor/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE();
    </script>
@endsection
