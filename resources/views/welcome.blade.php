@extends('layouts.app')

@section('script_header')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQhcjGnZdvndWtKz6gBmk6nRTTzbBVJlE" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>
@endsection

@section('style')
    <style type="text/css">
    	#mymap {
      		border:1px solid red;
      		width: 100%;
      		height: 500px;
    	}
  	</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Find an Event Near You</h2>
            <div id="mymap"></div>
        </div>
        <div class="col-md-6">
            <h2>Upcoming Events</h2>
        </div>
    </div>

    <h2>Latest Posts</h2>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-3">
                <div class="thumbnail">
                    @if ($post->image)
                        <img src="{{url('images/'.$post->image)}}" class="" alt="{{$post->title}} image">
                    @endif
                    <div class="caption">
                        <h3>{{$post->title}}</h3>
                        <p>{{$post->intro}}</p>
                        @foreach ($post->tags as $tag)
                            <a href="{{url('tags/'.$tag->slug)}}" class="badge badge-info">{{$tag->title}}</a>
                        @endforeach
                        <p>
                            <a href="{{url('posts/'.$post->slug)}}" class="btn btn-primary" role="button">Read More</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('script_footer')
    <script type="text/javascript">

        var events = <?php print_r(json_encode($events)) ?>;

        var mymap = new GMaps({
          el: '#mymap',
          lat: 27.9769107,
          lng: -82.1600645,
          zoom:14
        });

        $.each( events, function( index, value ){
            mymap.addMarker({
            lat: value.lat,
            lng: value.lng,
            title: value.name,
            infoWindow: {
                content: '<h1>'+value.name+'</h1>'
            }
            });
        });

  </script>
@endsection
