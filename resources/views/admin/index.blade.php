@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif

                    <h2>Tags</h2>
                    <ul>
                        <li><a href="{{route('admin.tag.index')}}">Index</a></li>
                        <li><a href="{{route('admin.tag.create')}}">Create</a></li>
                    </ul>

                    <h2>Posts</h2>
                    <ul>
                        <li><a href="{{route('admin.post.index')}}">Index</a></li>
                        <li><a href="{{route('admin.post.create')}}">Create</a></li>
                    </ul>


                    <h2>Venues</h2>
                    <ul>
                        <li><a href="{{route('admin.venue.index')}}">Index</a></li>
                        <li><a href="{{route('admin.venue.create')}}">Create</a></li>
                    </ul>

                    <h2>Events</h2>
                    <ul>
                        <li><a href="{{route('admin.event.index')}}">Index</a></li>
                        <li><a href="{{route('admin.event.create')}}">Create</a></li>
                    </ul>



                    <h2>Partners</h2>
                    <ul>
                        <li><a href="{{route('admin.partner.index')}}">Index</a></li>
                        <li><a href="{{route('admin.partner.create')}}">Create</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
