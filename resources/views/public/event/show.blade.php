@extends('layouts.app')

@section('content')
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    
    <div class="page-wrapper">
        <div class="row" style="border-bottom:2px dotted #000; padding-bottom:20px;">
            <div class="col-md-12">
                @if ($event->image)
                    <img src="/images/{{$event->image}}" class="img-responsive" alt="Responsive image">
                @endif
                <h1 style="text-transform:uppercase;font-weight:bold;">{{$event->name}}</h1>
                <p style="text-transform:uppercase;font-weight:bold;">{{$event->startdatetime->format('F dS')}} from {{$event->startdatetime->format('ga')}} to {{$event->enddatetime->format('ga')}}</p>
                <p>Location: <a href="https://www.google.com/maps/place/{{$event->venue->address}} {{$event->venue->city}}, FL {{$event->venue->zip}}" target="_blank">{{$event->venue->address}} {{$event->venue->city}}, FL {{$event->venue->zip}} <i class="fa fa-map-marker" aria-hidden="true"></i></a></p>
                <p style="font-style: italic;">{{$event->intro}}</p>
                <p>{!!Markdown::convertToHtml($event->description)!!}</p>
                <p>Presented by: <a href="/venues/{{$event->venue->slug}}">{{$event->venue->name}}</a></p>
                {{-- @foreach ($event->tags as $tag)
                    <a href="/tags/{{$tag->slug}}">{{$tag->title}}</a>
                @endforeach --}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Purchase:</h2>
            </div>
        </div>
        <div class="row" style="margin-bottom:100px;">
            <div class="col-md-12">

                @if($event->saleend < $now)
                    Sale ended
                @else
                    @if($event->presaleend > $now)

                        <script>
                            $(window).on("load", function(){
                                var handler = StripeCheckout.configure({
                                    key: '{{env('STRIPE_PUB_KEY')}}',
                                    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                                    token: function(token) {
                                        $("#stripeToken").val(token.id);
                                        $("#stripeEmail").val(token.email);
                                        $("#amountInCents").val(Math.floor($("#quantity").val() * {!! json_encode($event->presaleprice) !!}));
                                        $("#orderquantity").val($("#quantity").val());
                                        $("#paymentForm").submit();
                                    }
                                });
                    
                                $('#customButton').on('click', function(e) {
                                    var amountInCents = Math.floor($("#quantity").val() * {!! json_encode($event->presaleprice) !!});
                                    var displayAmount = parseFloat(Math.floor($("#quantity").val() * {!! json_encode($event->presaleprice) !!}) / 100).toFixed(2);
                                    
                                    // Open Checkout with further options
                                    handler.open({
                                        name: 'That Dance Guy',
                                        description: '{{$event->name}}',
                                        amount: amountInCents,
                                    });
                                    e.preventDefault();
                                });
                    
                                // Close Checkout on page navigation
                                $(window).on('popstate', function() {
                                    handler.close();
                                });
                            });
                        </script>
                                
                        <form class="form-inline" id="paymentForm" action="/events/payment/submit" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="stripeToken" name="stripeToken" />
                            <input type="hidden" id="stripeEmail" name="stripeEmail" />
                            <input type="hidden" id="amountInCents" name="amountInCents" />
                            <input type="hidden" id="orderquantity" name="orderquantity" />
                            <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
                            <div class="form-group">
                                <label for="quantity">${{$event->presaleprice/100}} per ticket x number of tickets</label>
                                <input type="text" class="form-control" id="quantity" placeholder="1" value="1">
                            </div>
                            <input type="button" class="btn btn-primary btn-sm" id="customButton" value="Purchase">
                        </form>
                        <p style="margin-top:5px;font-style: italic;">{{$event->presalenote}}</p>
                        
                    @else

                        <script>
                            $(window).on("load", function(){
                                var handler = StripeCheckout.configure({
                                    key: '{{env('STRIPE_PUB_KEY')}}',
                                    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                                    token: function(token) {
                                        $("#stripeToken").val(token.id);
                                        $("#stripeEmail").val(token.email);
                                        $("#amountInCents").val(Math.floor($("#quantity").val() * {!! json_encode($event->saleprice) !!}));
                                        $("#orderquantity").val($("#quantity").val());
                                        $("#paymentForm").submit();
                                    }
                                });
                    
                                $('#customButton').on('click', function(e) {
                                    var amountInCents = Math.floor($("#quantity").val() * {!! json_encode($event->saleprice) !!});
                                    var displayAmount = parseFloat(Math.floor($("#quantity").val() * {!! json_encode($event->saleprice) !!}) / 100).toFixed(2);
                                    
                                    // Open Checkout with further options
                                    handler.open({
                                        name: 'That Dance Guy',
                                        description: '{{$event->name}}',
                                        amount: amountInCents,
                                    });
                                    e.preventDefault();
                                });
                    
                                // Close Checkout on page navigation
                                $(window).on('popstate', function() {
                                    handler.close();
                                });
                            });
                        </script>    

                        <form class="form-inline" id="paymentForm" action="/events/payment/submit" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="stripeToken" name="stripeToken" />
                            <input type="hidden" id="stripeEmail" name="stripeEmail" />
                            <input type="hidden" id="amountInCents" name="amountInCents" />
                            <input type="hidden" id="orderquantity" name="orderquantity" />
                            <input type="hidden" name="event_id" id="event_id" value="{{$event->id}}">
                            <div class="form-group">
                                <label for="quantity">${{$event->saleprice/100}} per ticket x number of tickets</label>
                                <input type="text" class="form-control" id="quantity" placeholder="1" value="1">
                            </div>
                            <input type="button" class="btn btn-primary btn-sm" id="customButton" value="Purchase">
                        </form>
                        <p style="margin-top:5px;font-style: italic;">Ticket sale ends: {{$event->saleend->format('F dS').' '.$event->saleend->format('ga')}}</p>

                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection
