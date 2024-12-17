<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class StripeController extends Controller
{
//     public function process(Request $request)
// {
//     Stripe::setApiKey(config('services.stripe.secret'));

//     $amount = $request->input('amount'); // Amount in cents
//     $paymentIntent = PaymentIntent::create([
//         'amount' => $amount,
//         'currency' => 'eur',
//         'payment_method' => $request->input('payment_method_id'),
//         'confirmation_method' => 'manual',
//         'confirm' => true,
//     ]);

//     // Redirect to a success page or a route after successful payment
//     return redirect()->route('payment.success'); // Change to an appropriate route
// }


//      // Display the Stripe payment form
//      public function showStripeForm(Request $request)
//      {
//          $amount = $request->input('amount'); // Get the amount from the request
//          if (!$amount) {
//              return redirect()->back()->with('error', 'Amount is required to proceed with payment.');
//          }

//          return view('payements.stripe-form', compact('amount'));
//      }

    }
