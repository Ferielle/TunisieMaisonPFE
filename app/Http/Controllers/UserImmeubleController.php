<?php

namespace App\Http\Controllers;

use App\Models\Immeuble;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class UserImmeubleController extends Controller
{
    public function index(Request $request)
    {
        $query = Immeuble::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ville', 'like', "%{$search}%");
        }

        $immeubles = $query->get();
        return view('index', compact('immeubles'));
    }



//reserve action verify payement before displaying details




public function reserve($id, Request $request) {
    $immeuble = Immeuble::findOrFail($id);
    $amount = $immeuble->price * 100; // En centimes

    // Proceed to payment view, return client secret
    return view('payment', [
        'client_secret' => $this->createPaymentIntent($amount),
        'immeuble_id' => $id
    ]);
}







    public function showDetails($id) {
        $immeuble = Immeuble::findOrFail($id);

        // Check if the user has reserved this `immeuble`
        $reservation = Reservation::where('user_id', auth()->user()->id)
                                  ->where('immeuble_id', $id)
                                  ->where('status', 'reserved')
                                  ->first();

        if (!$reservation) {
            return redirect()->back()->with('error', 'You must reserve this `immeuble` to view its details.');
        }

        return view('immeubles.details', compact('immeuble'));
    }







    protected function createPaymentIntent($amount)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
        ]);

        return $paymentIntent->client_secret;
    }

    public function processPayment(Request $request)
{
    $paymentIntentId = $request->input('payment_intent');
    $immeubleId = $request->input('immeuble_id');

    Stripe::setApiKey(config('services.stripe.secret'));

    try {
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

        if ($paymentIntent->status === 'succeeded') {
            // Find the immeuble and reserve it for the user
            $immeuble = Immeuble::find($immeubleId);
            if ($immeuble) {
                // Create a new reservation for the user
                $reservation = new Reservation();
                $reservation->user_id = auth()->user()->id;
                $reservation->immeuble_id = $immeuble->id;
                $reservation->status = 'reserved';
                $reservation->save();

                // Redirect to details page
                return redirect()->route('user.immeubles.details', $immeuble->id)
                    ->with('success', 'Payment successful! You can now view the full details.');
            }
        } else {
            return redirect()->route('index')->with('error', 'Payment failed.');
        }
    } catch (\Exception $e) {
        // Log the error or show it on the front-end
        return redirect()->route('index')->with('error', 'Payment verification failed: ' . $e->getMessage());
    }

    return redirect()->route('index')->with('error', 'Payment failed or property not found!');
}







    /*
    public function show($id)
    {
        $immeuble = Immeuble::findOrFail($id);
        return view('show', compact('immeuble'));
    }*/

}
