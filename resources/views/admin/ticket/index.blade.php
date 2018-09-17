@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin - All Ticket Sales</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Ticket Number</th>
                        <th>Email</th>
                        <th>Amount Paid</th>
                        <th>Event Name</th>
                        <th>Purchased</th>
                        <th>Purchased</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->ticket_number}}</td>
                        <td>{{$ticket->email}}</td>
                        <td>${{$ticket->amount_paid / 100}}</td>
                        <td>{{$ticket->event_name}}</td>
                        <td>{{$ticket->created_at->format('d-m-Y')}} {{$ticket->created_at->format('h:i:s A')}}</td>
                        <td>{{$ticket->order_quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
