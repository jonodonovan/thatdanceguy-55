@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    @include('partials.alerts')
    <div class="row">
        <div class="col-md-12">
            <h1>Who's That Dance Guy?</h1>
        </div>
    </div>
    <div class="row" style="margin-bottom:20px;">
        <div class="col-md-12">
            <center>
                <img src="/theme/nathan.jpg" name="aboutme" width="200" border="0" class="img-circle">
                <h1>Nathan Foreman</h1>
                <h4><span class="label label-default">Dance Instructor</span>
                <span class="label label-default">Dance Host/Taxi Dancer</span>
                <span class="label label-default">DJ/Mc</span>
                <span class="label label-default">Event Coordinator</span></h4>
                <br>
                <p class="text-left">Nathan Foreman has been teaching social dance for nearly 20 years, in three different languages.  His teaching style is very connection based, striving to develop true communication between leader and follower, between dancers and spectators, between body and mind, and between Earth and Alpha Centauri. When you take lessons from him, you are continually rewarded as you find the difficult becoming easy, and yet challenged as you realize suddenly that the easy is actually difficult. But it is all a part of learning process and if you have fun while you dance - you are with the right teacher!</p>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Contact Nathan</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('contact.submit')}}">
            {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="companyname" id="companyname" placeholder="Company Name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phonenumber" id="phonenumber" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <textarea rows="5" id="message" class="form-control" name="message" value="{{ old('message') }}"></textarea>
                </div>
                <button type="submit" class="btn btn-default btn-lg">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection
