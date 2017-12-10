@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h2>All Tags</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width:20%">Title</th>
                        <th style="width:50%">Description</th>
                    </tr>
                </thead>
                <tbody>
                <?php  $count = 1; ?>
                @foreach ($posts as $post)
                    <tr>
                        <th>{{$count++}}</th>
                        <td><a href="{{url('tags/'.$tag->slug)}}">{{$tag->title}}</a></td>
                        <td>{{$tag->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
