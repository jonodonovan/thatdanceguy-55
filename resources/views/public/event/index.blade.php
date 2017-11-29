@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h2>All Events</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                <?php  $count = 1; ?>
                @foreach ($events as $event)
                    <tr>
                        <th>{{$count++}}</th>
                        <td><a href="{{url('events/'.$event->slug)}}">{{$event->name}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
