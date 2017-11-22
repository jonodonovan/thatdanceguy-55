@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">All Venues</div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php  $count = 1; ?>

                        @foreach ($venues as $venue)
                            <tr>
                                <th>{{$count++}}</th>
                                <td><a href="{{url('venues/'.$venue->slug)}}">{{$venue->name}}</a></td>
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
