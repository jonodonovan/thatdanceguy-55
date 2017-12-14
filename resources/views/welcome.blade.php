@extends('layouts.app')

@section('script_header')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQhcjGnZdvndWtKz6gBmk6nRTTzbBVJlE"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
@endsection

@section('style')
    <style type="text/css">
    	#mymap {
      		width: 100%;
      		height: 500px;
    	}
  	</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12" style="padding-right:0px;padding-left:0px;">
            <div class="map-container">
                <div id="mymap"></div>
            </div>
        </div>
    </div>

    <div class="row" style="padding:15px;">
        <div class="col-md-12" style="padding-right:0px;padding-left:0px;">
            <h3 style="color:white;text-transform:uppercase;">Upcoming Events</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($events as $event)
            <div class="col-md-3" style="padding:0 5px;">
                <div class="all-events">
                    <a href="{{url('events/'.$event->slug)}}" style="text-decoration:none;">
                    <div class="thumbnail">
                        <div class="caption" style="text-align:left;">
                            <h3 style="font-size:26px;font-weight:bold;text-transform:uppercase;">{{$event->name}}</h3>
                            <small style="font-weight:bold;">{{$event->startdatetime->format('F dS')}}</small>
                            <small>from {{$event->startdatetime->format('ga')}} to {{$event->enddatetime->format('ga')}}</small>
                            <p>{{$event->intro}}</p>


                        </div>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row" style="padding:15px;">
        <div class="col-md-12" style="padding-right:0px;padding-left:0px;">
            <h3 style="color:white;text-transform:uppercase;">Latest Posts</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-3" style="padding:0 5px;">
                <div class="thumbnail">
                    @if ($post->image)
                        <img src="{{url('images/'.$post->image)}}" class="" alt="{{$post->title}} image">
                    @endif
                    <div class="caption">
                        <h3 style="font-size:26px;font-weight:bold;text-transform:uppercase;">{{$post->title}}</h3>
                        <p>{{$post->intro}}</p>
                        <p>
                            <a href="{{url('posts/'.$post->slug)}}" class="btn btn-primary" role="button">Read More</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script_footer')

<script type="text/javascript">

        var events = <?php print_r(json_encode($events)) ?>;

        var mymap = new GMaps({
          el: '#mymap',
          lat: 27.9769107,
          lng: -82.1600645,
          zoom:10,
          disableDefaultUI: true,
          styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
        });

        $.each( events, function( index, value ){
            mymap.addMarker({
                id: value.id,
                lat: value.lat,
                lng: value.lng,
                title: value.name,
                infoWindow: {
                    content: '<h1>'+value.name+'</h1><br /><a href="/events/'+value.slug+'">'+value.slug+'</a>'
                }
            });
        });

  </script>


<script>
$("#maplinks a").click(function(event){
        event.preventDefault();
        var markerid = $(event.target).data("markerid");

        $.each(markers,function (){
            if (this.id == markerid){
                var lat = this.position.lat();
                var lon = this.position.lng();

                var center = new google.maps.LatLng(lat, lon);
                gmap.panTo(center);
                gmap.setZoom(6);
                google.maps.event.trigger(this, 'click', {});

            }
        });
    });
</script>
@endsection
