@extends('layouts.app')

@section('script_header')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQhcjGnZdvndWtKz6gBmk6nRTTzbBVJlE"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.25/gmaps.js"></script> --}}
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js"></script>
@endsection

@section('style')
    <style type="text/css">
    	#map2 {
      		width: 100%;
      		height: 500px;
    	}
  	</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="map-container">
                {{-- <div id="mymap"></div> --}}
                <div id="map2" class="gmap3"></div>
                <div id="maplinks" class="upcoming">
                @foreach ($upcomingevents as $upcomingevent)
                    {{-- <a style="color:white;text-decoration:none;" href="{{url('events/'.$upcomingevent->slug)}}"> --}}
                    <a style="color:white;text-decoration:none;" href="#" data-lat="{{$upcomingevent->lat}}" data-lon="{{$upcomingevent->lng}}" data-markerid="{{$upcomingevent->id}}">
                        <div class="row upcoming-event-container">
                            <div class="col-md-3 upcoming-event-date">
                                {{$upcomingevent->startdatetime->format('M')}} <br>
                                {{$upcomingevent->startdatetime->format('d')}}
                            </div>
                            <div class="col-md-9 upcoming-event-info">
                                <span class="event-name">
                                    {{$upcomingevent->name}}
                                    <br>
                                </span>
                                <span class="event-tag">
                                    {{$upcomingevent->intro}}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="padding:15px;">
        <div class="col-md-12">
            <h3>All Events</h3>
        </div>
    </div>
    <div class="row">
        @foreach ($events as $event)
            <div class="col-md-3">
                <div class="all-events">
                    <a href="{{url('events/'.$event->slug)}}" style="text-decoration:none;">
                    <div class="thumbnail">
                        <div class="caption" style="text-align:center;">
                            <h3 style="font-weight:bold;">{{$event->name}}</h3>
                            <p>{{$event->intro}}</p>
                            <p style="font-weight:bold;">{{$event->startdatetime->format('F dS')}}</p>
                            <p>{{$event->startdatetime->format('ga')}} - {{$event->enddatetime->format('ga')}}</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Latest Posts</h3>
        </div>
    </div>
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
<script>

$(function () {
    var gmap, infowindow;
    var markers = [];

    $('#maplinks a').each(function () {
        var $this = $(this);
        var htmltxt = $this.html();
        var position = {lat: parseFloat($this.data('lat')), lng: parseFloat($this.data('lon'))};
        var data = {
            position: position,
            id: $this.data('markerid'),
            data: "<div class='event-map'>" + htmltxt + "</div>"
        };

        $this.click(function () {
            event.preventDefault();
            if (infowindow && data.marker) {
              infowindow.setContent(htmltxt);
              gmap.setZoom(16);
              gmap.panTo(position);
              infowindow.open(gmap, data.marker);
            }
        });
        markers.push(data);
    });

    $("#map2")
    .gmap3({
        center: [27.950078, -82.451228],
        zoom: 10,
        styles:
        [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
    })
    .then(function (_gmap) {
        gmap = _gmap;
    })
    .infowindow({
        content: ''
    })
    .then(function (iw) {
        infowindow = iw;
    })
    .cluster({
        size: 200,
        markers: markers,
        cb: function (markers) {
            // if (markers.length > 1) { // 1 marker stay unchanged (because cb returns nothing)
            //     if (markers.length < 20) {
            //         return {
            //             content: "<div class='cluster cluster-1' style='color:white;'>" + markers.length + "</div>",
            //             x: -26,
            //             y: -26
            //         };
            //     }
            //     if (markers.length < 50) {
            //         return {
            //             content: "<div class='cluster cluster-2'>" + markers.length + "</div>",
            //             x: -26,
            //             y: -26
            //         };
            //     }
            //     return {
            //         content: "<div class='cluster cluster-3'>" + markers.length + "</div>",
            //         x: -33,
            //         y: -33
            //     };
            // }
        }
    })
    .then(function (cluster) {
        $.each(cluster.markers(), function (_, marker) {
            $.each(markers, function (_, data) {
                if (data.id === marker.id) {
                    data.marker = marker;
                }
            });
        })
    })
    .on('click', function (marker, clusterOverlay, cluster, event) {
        if (marker) {
            infowindow.setContent(marker.data);
            infowindow.open(marker.getMap(), marker);
        }
    });
});
</script>
@endsection
