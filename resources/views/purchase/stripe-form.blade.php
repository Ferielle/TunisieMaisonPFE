




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Complete Your Payment</h1>
    <p>Amount to Pay: ${{ $amount }}</p>

    <form id="payment-form">
        <div id="card-element"><!-- Stripe.js injects the Card Element here --></div>
        <button type="submit" id="submit-button">Pay Now</button>
        <p id="error-message"></p>
    </form>

    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}"); // Stripe Public Key
        const clientSecret = "{{ $client_secret }}"; // Pass the client_secret here

        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Confirm the card payment
            const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: { card: cardElement }
            });

            if (error) {
                // Display error message
                errorMessage.textContent = error.message;
            } else if (paymentIntent.status === 'succeeded') {
                // Redirect to success page with query parameters
                window.location.href = `/payment/success?id={{ $immeuble_id }}`;
            }
        });
    </script>
</body>
</html>
