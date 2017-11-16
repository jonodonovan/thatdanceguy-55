@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('admin')}}">Admin</a> - All Tags | <small><a href="{{route('admin.tag.create')}}">new</a></small>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="width:30%">Title</th>
                                <th style="width:50%">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php  $count = 1; ?>

                        @foreach ($tags as $tag)
                            <tr>
                                <th>{{$count++}}</th>
                                <td>
                                    <a href="{{url('admin/tag/'.$tag->slug)}}">{{$tag->title}}</a>
                                </td>
                                <td>
                                    {{$tag->description}}
                                </td>
                                <td>
                                    <a href="{{url('admin/tag/'.$tag->slug.'/edit')}}">edit</a> | <a href="#" data-toggle="modal" data-target="#{{$tag->id}}">delete</a>
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

@foreach ($tags as $tag)
    <div class="modal fade" id="{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Delete <span style="text-transform:uppercase;">{{$tag->title}}</span>?</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span style="text-transform:uppercase;font-weight:bold;">{{$tag->title}}</span> tag?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{route('admin.tag.destroy', $tag->id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Yes, delete!</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
