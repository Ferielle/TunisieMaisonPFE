
// document.getElementById('pay-card').addEventListener('click', async () => {
//     const stripe = Stripe('{{ env("STRIPE_KEY") }}');

//     const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
//         payment_method: {
//             card: elements.create('card'),
//         },
//     });

//     if (error) {
//         alert(`Payment failed: ${error.message}`);
//     } else {
//         alert('Payment successful!');
//         window.location.href = '/purchase-success'; // Redirect to success page
//     }
// });

// document.getElementById('pay-card').addEventListener('click', () => {
//     const amount = document.getElementById('product-amount').value; // Assuming a hidden input field for the product amount
//     const redirectUrl = `/pay-with-card?amount=${amount}`;
//     window.location.href = redirectUrl;
// });

// document.getElementById('pay-card').addEventListener('click', () => {
//     alert('Redirecting to card payment...');
//     window.location.href = '/pay-with-card';
// });
// // public/js/test.js
// // document.getElementById('pay-bitcoin').addEventListener('click', async () => {
// //     alert('Redirecting to bitcoin payment...');
// //     window.location.href = '/blockchainpayement';


// // });

document.getElementById('pay-card').addEventListener('click', async () => {
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');

    const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
        payment_method: {
            card: elements.create('card'),
        },
    });

    if (error) {
        alert(`Payment failed: ${error.message}`);
    } else {
        alert('Payment successful!');
        window.location.href = '/purchase-success'; // Redirect to success page
    }
});
document.getElementById('pay-card').addEventListener('click', () => {
    const amount = document.getElementById('product-amount').value; // Get the amount from the hidden input
    if (amount) {
        const redirectUrl = `/pay-with-card?amount=${amount}`;
        window.location.href = redirectUrl; // Redirect to the payment page with the amount
    } else {
        alert('Amount is not available.');
    }
});



document.getElementById('pay-card').addEventListener('click', () => {
    alert('Redirecting to card payment...');
    window.location.href = '/pay-with-card';
});
// public/js/test.js
// document.getElementById('pay-bitcoin').addEventListener('click', async () => {
//     alert('Redirecting to bitcoin payment...');
//     window.location.href = '/blockchainpayement';


// });
