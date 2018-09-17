@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        @include('partials.alerts')
        <div class="row hidden-print">
            <div class="col-md-12">
                <h1>Thank you! Below are your tickets for the event.</h1>
                <div class="alert alert-info" role="alert"><b>Order number:</b> {{$ticket->slug}}</div>
                <div class="pull-left hidden-print">
                    <button class="btn btn-default" onclick="myFunction()" style="margin-bottom:50px;">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                        Print your tickets
                    </button>
                </div>
            </div>
        </div>

        @foreach ($tickets as $ticket )
            <div class="row" style="border:2px dotted #000;margin:25px;padding:20px;page-break-after: always;">
                <div class="col-sm-8 col-md-6">
                    <p style="text-transform:uppercase;font-size:24px;">{{$ticket->event_name}}</p>
                    <p>At {{$ticket->event->venue->name}} starting at {{$ticket->event->startdatetime->format('F dS')}} from {{$ticket->event->startdatetime->format('ga')}} to {{$ticket->event->enddatetime->format('ga')}}</p>
                    @if ($ticket->event->address)
                        <p>Address: {{$ticket->event->address}} {{$ticket->event->city}}, FL {{$ticket->event->zip}}</p>
                    @else
                        <p>Address: {{$ticket->event->venue->address}} {{$ticket->event->venue->city}}, FL {{$ticket->event->venue->zip}}</p>
                    @endif
                    <p>Ticket Number:</p>
                    <span style="background-color:#F5F5F5;padding:5px;font-weight:bold;">{{$ticket->ticket_number}}</span>
                </div>
                <div class="hidden-xs hidden-sm col-md-6">
                    <img src="/theme/Logo_black.svg" alt="" class="pull-right" style="width:150px;">
                </div>
                <div class="hidden-md hidden-lg col-sm-4">
                    <img src="/theme/Logo_black.svg" alt="" class="pull-right" style="width:100px;">
                </div>
            </div>
        @endforeach

    </div>

    <script type="text/javascript">
        function myFunction() {
            window.print();
        }
    </script>
@endsection
