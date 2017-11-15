@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">All Posts</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width:20%">Title</th>
                                <th style="width:20%">Intro</th>
                                <th style="width:50%">Body</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php  $count = 1; ?>

                        @foreach ($posts as $post)
                            <tr>
                                <th>{{$count++}}</th>
                                <td><a href="{{url('posts/'.$post->slug)}}">{{$post->title}}</a></td>
                                <td>{{$post->intro}}</td>
                                <td>{{$post->body}}</td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
