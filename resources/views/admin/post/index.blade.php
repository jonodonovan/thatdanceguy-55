@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('admin')}}">Admin</a> - All Posts | <small><a href="{{route('admin.post.create')}}">new</a></small>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width:20%">Title</th>
                                <th style="width:20%">Intro</th>
                                <th style="width:50%">Body</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php  $count = 1; ?>

                        @foreach ($posts as $post)

                            <tr>
                                <th>{{$count++}}</th>
                                <td><a href="{{url('admin/post/'.$post->slug)}}">{{$post->title}}</a></td>
                                <td>{{$post->intro}}</td>
                                <td>{{$post->body}}</td>
                                <td>
                                    <a href="{{url('admin/post/'.$post->slug.'/edit')}}">edit</a> |
                                    <a href="#" data-toggle="modal" data-target="#{{$post->id}}">delete</a>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($posts as $post)
<div class="modal fade" id="{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Delete <span style="text-transform:uppercase;">{{$post->title}}</span>?</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span style="text-transform:uppercase;font-weight:bold;">{{$post->title}}</span> post?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route('admin.post.destroy', $post->id)}}">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Yes, delete!</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel!</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
