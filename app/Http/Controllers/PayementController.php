<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Immeuble;

class PayementController extends Controller
{


    public function showStripeForm(Request $request)
    {
        $amount = $request->query('amount', 0); // Get amount from query string
        $immeubleId = $request->query('id'); // Get immeuble id if passed

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount * 100, // Amount in cents
                'currency' => 'usd',       // Adjust as needed
                'metadata' => ['immeuble_id' => $immeubleId], // Optional: store related info
            ]);

            $clientSecret = $paymentIntent->client_secret;

            // Pass client_secret and amount to the view
            return view('purchase.stripe-form', [
                'client_secret' => $clientSecret,
                'amount' => $amount,
                'immeuble_id' => $immeubleId
            ]);
        } catch (\Exception $e) {
            // Redirect with error message if PaymentIntent fails
            return redirect()->back()->with('error', 'Error creating payment: ' . $e->getMessage());
        }
    }

    public function process(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    try {
        // Create the PaymentIntent with the provided amount
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount * 100, // Amount in cents
            'currency' => 'usd',
        ]);

        // Pass the client_secret to the stripe-form view
        return view('purchase.stripe-form', [
            'client_secret' => $paymentIntent->client_secret,
            'amount' => $request->amount
        ]);
    } catch (\Exception $e) {
        // Redirect to an error page with an error message
        return redirect()->back()->with('error', 'Error creating payment: ' . $e->getMessage());
    }
}


public function successPage(Request $request)
{
    $immeubleId = $request->query('id'); // Retrieve the immeuble ID
    $immeuble = Immeuble::find($immeubleId);

    return view('purchase.success', [
        'immeuble' => $immeuble
    ]);
}

}
