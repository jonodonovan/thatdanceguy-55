@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="/vendor/simplemde.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
@endsection

@section('script_header')
    <script src="https://unpkg.com/flatpickr"></script>
@endsection

@section('content')
<div class="page-wrapper">
    @include('partials.alerts')
    <form method="POST" action="{{route('admin.event.store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="row">
            <h1 style="text-transform:uppercase;">Create a new event</h1>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('name') ? ' has-error' : ''}}">
                    <label for="name" class="control-label">Event Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}"  autofocus>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('intro') ? ' has-error' : ''}}">
                    <label for="intro" class="control-label">Event Intro</label>
                    <input id="intro" type="text" class="form-control" name="intro" value="{{old('intro')}}" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{$errors->has('description') ? ' has-error' : ''}}">
                    <label for="description" class="control-label">Event Description</label>
                    <textarea rows="10" id="description" class="form-control" name="description">{{old('description')}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group {{$errors->has('image') ? ' has-error' : ''}}">
                    <label for="image" class="control-label">Event Image Banner</label><br />
                    <input type="file" id="image" class="form-control" name="image"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="startdatetime" class="control-label">Start Date & Time</label>
                    <input id="startdatetime" type="text" class="form-control" name="startdatetime">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="enddatetime" class="control-label">End Date & Time</label>
                    <input id="enddatetime" type="text" class="form-control" name="enddatetime">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tagselect">Tag</label>
                    <select multiple class="form-control" id="tagselect" name="tagselect[]">
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{$errors->has('facebook') ? ' has-error' : ''}}">
                    <label for="facebook" class="control-label">Facebook Event Link</label>
                    <input id="facebook" type="text" class="form-control" name="facebook" value="{{old('facebook', 'https://www.facebook.com/pages/...')}}" >
                </div>
            </div>
        </div>
        <div style="background-color:#B2EBF2;margin-bottom:10px;padding:10px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);">
            <div class="row">
                <div class="col-md-12">
                    <h2>Venue Info - <small>Leave address blank if same as selected venue</small></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group {{$errors->has('venue_id') ? ' has-error' : ''}}">
                        <label for="venue_id">Venue</label>
                        <select class="form-control" id="venue_id" name="venue_id">
                            <option value="">Select</option>
                            @foreach ($venues as $venue)
                                <option value="{{$venue->id}}">{{$venue->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{$errors->has('address') ? ' has-error' : ''}}">
                        <label for="address" class="control-label">Address <em>(Street)</em></label>
                        <input id="address" type="text" class="form-control" name="address" value="{{old('address')}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{$errors->has('city') ? ' has-error' : ''}}">
                        <label for="city" class="control-label">City</label>
                        <input id="city" type="text" class="form-control" name="city" value="{{old('city')}}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group {{$errors->has('zip') ? ' has-error' : ''}}">
                        <label for="zip" class="control-label">Zip</label>
                        <input id="zip" type="text" class="form-control" name="zip" value="{{old('zip')}}">
                    </div>
                </div>
            </div>
        </div>
        <div style="background-color:#BBDEFB;margin-bottom:50px;padding:10px;box-shadow: 0 4px 6px rgba(50,50,93,.11), 0 1px 3px rgba(0,0,0,.08);">
            <div class="row">
                <div class="col-md-12">
                    <h2>Ticketing Info</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {{$errors->has('presaleticketprice') ? ' has-error' : ''}}">
                        <label for="presaleticketprice" class="control-label">Presale Ticket Price <em>(in cents)</em></label>
                        <input id="presaleticketprice" type="text" class="form-control" name="presaleticketprice" value="{{old('presaleticketprice')}}" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="presalestartdatetime" class="control-label">Presale Start Date & Time</label>
                        <input id="presalestartdatetime" type="text" class="form-control" name="presalestartdatetime">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="presaleenddatetime" class="control-label">Presale End Date & Time</label>
                        <input id="presaleenddatetime" type="text" class="form-control" name="presaleenddatetime">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group {{$errors->has('presalenote') ? ' has-error' : ''}}">
                        <label for="presalenote" class="control-label">Presale Note</label>
                        <input id="presalenote" type="text" class="form-control" name="presalenote" value="{{old('presalenote')}}" >
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group {{$errors->has('saleticketprice') ? ' has-error' : ''}}">
                        <label for="saleticketprice" class="control-label">Sale Ticket Pice <em>(in cents)</em></label>
                        <input id="saleticketprice" type="text" class="form-control" name="saleticketprice" value="{{old('saleticketprice')}}" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="salestartdatetime" class="control-label">Sale Start Date & Time</label>
                        <input id="salestartdatetime" type="text" class="form-control" name="salestartdatetime">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="saleenddatetime" class="control-label">Sale End Date & Time</label>
                        <input id="saleenddatetime" type="text" class="form-control" name="saleenddatetime">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group {{$errors->has('salenote') ? ' has-error' : ''}}">
                        <label for="salenote" class="control-label">Sale Note</label>
                        <input id="salenote" type="text" class="form-control" name="salenote" value="{{old('salenote')}}" >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a class="btn btn-default" href="{{route('admin.event.index')}}">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Event</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script_footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript">
        flatpickr("#startdatetime", {
            defaultDate: 'today',
            altInput: true,
            enableTime: true,
            dateFormat: 'Y-m-d H:i:s'
        });
        flatpickr("#enddatetime", {
            defaultDate: 'today',
            altInput: true,
            enableTime: true,
            dateFormat: 'Y-m-d H:i:s'
        });
        flatpickr("#presalestartdatetime", {
            defaultDate: 'today',
            altInput: true,
            enableTime: true,
            enableSeconds: true,
            dateFormat: 'Y-m-d H:i:s'
        });
        flatpickr("#presaleenddatetime", {
            defaultDate: 'today',
            altInput: true,
            enableTime: true,
            enableSeconds: true,
            dateFormat: 'Y-m-d H:i:s'
        });
        flatpickr("#salestartdatetime", {
            defaultDate: 'today',
            altInput: true,
            enableTime: true,
            enableSeconds: true,
            dateFormat: 'Y-m-d H:i:s'
        });
        flatpickr("#saleenddatetime", {
            defaultDate: 'today',
            altInput: true,
            enableTime: true,
            enableSeconds: true,
            dateFormat: 'Y-m-d H:i:s'
        });
    </script>
    <script src="/vendor/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE();
    </script>
@endsection
