@extends('layouts.app')

@section('content')
<div class="page-wrapper" style="background-color:white;padding:50px;">
    <div class="row">
        <h1 style="text-transform:uppercase;">Welcome {{Auth::user()->name}}</h1>
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif
            <a href="{{route('admin.tag.index')}}"><h2>Tags <a href="{{route('admin.tag.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></h2></a>
            <a href="{{route('admin.venue.index')}}"><h2>Venues <a href="{{route('admin.venue.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></h2></a>
            <a href="{{route('admin.event.index')}}"><h2>Events <a href="{{route('admin.event.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></h2></a>
            <a href="{{route('admin.post.index')}}"><h2>Posts <a href="{{route('admin.post.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></h2></a>
            <a href="{{route('admin.partner.index')}}"><h2>Partners <a href="{{route('admin.partner.create')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></h2></a>
            <a href="{{route('admin.contact.index')}}"><h2>Contacts</h2></a>
        </div>
    </div>
</div>
@endsection
