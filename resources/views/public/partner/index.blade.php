@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h2 style="margin-bottom:50px;">Partners</h2>
        </div>
    </div>
    <div class="row">
        @foreach ($partners as $partner)
            <div class="col-md-3">
                <div class="all-events">
                    <a href="{{url('partners/'.$partner->slug)}}" style="text-decoration:none;">
                    <div class="thumbnail" style="border: 2px solid #000000;">
                        <div class="caption" style="">
                            <h3 style="font-weight:bold;">{{$partner->name}}</h3>
                            <p>{{$partner->intro}}</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
