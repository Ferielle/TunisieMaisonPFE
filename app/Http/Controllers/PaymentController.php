<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Immeuble;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $amount = $request->input('amount'); // Amount in cents
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'payment_method' => $request->input('payment_method_id'),
            'confirmation_method' => 'manual',
            'confirm' => true,
        ]);

        return response()->json([
            'client_secret' => $paymentIntent->client_secret,
        ]);
    }
}
