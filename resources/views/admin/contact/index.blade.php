@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin - All Contacts</h1>
            <div class="pull-right"><a href="{{route('admin')}}"><i class="fa fa-chevron-circle-left fa-2x" aria-hidden="true"></i></a> <a href="{{route('admin.event.create')}}"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width:5%">#</th>
                        <th style="width:10%">Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th style="width:50%">Message</th>
                    </tr>
                </thead>
                <tbody>
                <?php  $count = 1; ?>
                @foreach ($contacts as $contact)
                    <tr>
                        <th>{{$count++}}</th>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->companyname}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phonenumber}}</td>
                        <td>{{$contact->message}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
