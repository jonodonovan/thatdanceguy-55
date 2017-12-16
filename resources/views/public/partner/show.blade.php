@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$partner->name}}</h1>
            <p style="font-style: italic;">{!!Markdown::convertToHtml($partner->intro)!!}</p>
        </div>
    </div>
</div>
@endsection
