@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>All Posts</h1>
        </div>
    </div>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-3">
                <div class="thumbnail">
                    @if ($post->image)
                        <img src="{{url('images/'.$post->image)}}" class="" alt="{{$post->title}} image">
                    @endif
                    <div class="caption">
                        <h2>{{$post->title}}</h2>
                        <small>Posted {{$post->startdatetime->format('F dS')}}</small>
                        <p>{{$post->intro}}</p>
                        <p>
                            <a href="{{url('posts/'.$post->slug)}}" class="btn btn-primary" role="button">Read More</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
