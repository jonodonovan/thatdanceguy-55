<?php

namespace App\Http\Controllers;

use App\Event;
use App\Ticket;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Session;
use Carbon\Carbon;
use App\Mail\Thankyou;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        try {
            $event = Event::where('id', '=', $request->event_id)->firstOrFail();
            $now = Carbon::today()->toDateTimeString();

            if ($event->saleend < $now) {
                return abort(404);
            } else {
                if ($event->presaleend > $now) {
                    $total = $event->presaleprice;
                } else {
                    $total = $event->saleprice;
                }
            }

            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $customer = Customer::create(array(
                'email'         => $request->stripeEmail,
                'source'        => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer'      => $customer->id,
                'amount'        => $request->orderquantity * $total,
                'currency'      => 'usd',
                'description'   => $event->name.' - '.$request->orderquantity
            ));

            $slug = str_random(2).Carbon::now()->hour.str_random(10);

            for ($i=0; $i < $request->orderquantity ; $i++){
                $ticket = new Ticket;
                $ticket->event_id       = $event->id;
                $ticket->slug           = $slug;
                $ticket->ticket_number  = str_random(4).Carbon::now()->hour.str_random(4);
                $ticket->email          = $request->stripeEmail;
                $ticket->amount_paid    = $total;
                $ticket->event_name     = $event->name;
                $ticket->order_quantity = $request->orderquantity;
                $ticket->save();
            }

            // Mail::to($request->stripeEmail)->send(new Thankyou($slug));

			Session::flash('status', 'Payment received!');
            Session::flash('other2', 'An email confirmation is on its way.');
            return redirect()->route('thankyou', $slug);

        } catch (\Exception $ex) {

            return $ex->getMessage();

        }
    }
}
