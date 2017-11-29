@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h2>All Venues</h2>
            <div class="pull-right"><a href="{{route('admin')}}"><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a> <a href="{{route('admin.venue.create')}}"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width:30%">Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php  $count = 1; ?>
                @foreach ($venues as $venue)
                    <tr>
                        <th>{{$count++}}</th>
                        <td>
                            <a href="{{url('admin/venue/'.$venue->slug)}}">{{$venue->name}}</a>
                        </td>
                        <td>
                            <a href="{{url('admin/venue/'.$venue->slug.'/edit')}}">edit</a> |
                            <a href="#" data-toggle="modal" data-target="#{{$venue->id}}">delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($venues as $venue)
    <div class="modal fade" id="{{$venue->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Delete <span style="text-transform:uppercase;">{{$venue->name}}</span>?</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span style="text-transform:uppercase;font-weight:bold;">{{$venue->name}}</span> venue?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{route('admin.venue.destroy', $venue->id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Yes, delete!</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
