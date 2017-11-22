@extends('layouts.app')

@section('content')
<div class="page-wrapper" style="background-color:white;padding:50px;">
    <div class="row">
        <div class="col-md-12">
            <h2>All Events</h2>
            <div class="pull-right"><a href="{{route('admin')}}"><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a> <a href="{{route('admin.event.create')}}"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width:10%">Name</th>
                        <th style="width:20%">Start</th>
                        <th style="width:20%">End</th>
                        <th style="width:30%">Intro</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php  $count = 1; ?>
                @foreach ($events as $event)
                    <tr>
                        <th>{{$count++}}</th>
                        <td><a href="{{url('admin/event/'.$event->slug)}}">{{$event->name}}</a></td>
                        <td>{{$event->startdatetime->toDayDateTimeString()}}</td>
                        <td>{{$event->enddatetime->toDayDateTimeString()}}</td>
                        <td>{{$event->intro}}</td>
                        <td>
                            <a href="{{url('admin/event/'.$event->slug.'/edit')}}">edit</a> |
                            <a href="#" data-toggle="modal" data-target="#{{$event->id}}">delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($events as $event)
<div class="modal fade" id="{{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Delete <span style="text-transform:uppercase;">{{$event->name}}</span>?</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span style="text-transform:uppercase;font-weight:bold;">{{$event->name}}</span> event?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{route('admin.event.destroy', $event->id)}}">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Yes, delete!</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel!</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
