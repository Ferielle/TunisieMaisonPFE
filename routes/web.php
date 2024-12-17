<?php
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserImmeubleController;
use App\Http\Controllers\BlockchainController;
use App\Http\Controllers\EmailController;
use App\Admin\Controllers\ImmeubleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\HomeController;

// Route to send Ether to a contract
Route::post('/send-ether', [BlockchainController::class, 'sendEther'])->name('send.ether');

// Route to check the balance of a deployed contract
Route::get('/contract-balance', [BlockchainController::class, 'getContractBalance'])->name('contract.balance');

// Route for home/dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list', [App\Http\Controllers\HomeController::class, 'list'])->name('list');
//Route::get('/admin', [HomeController::class, 'index'])->name('admin.home');

// Authentication Routes
Auth::routes();

// Profile management routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');



    // //added recently
    // Route::get('/immeubles/reserve/{id}', [UserImmeubleController::class, 'reserve'])->name('user.immeubles.reserve');
    // Route::get('/reserve/{id}', [UserImmeubleController::class, 'reserve'])->name('reserve');
    // Route::post('/immeubles/payment', [PaymentController::class, 'process'])->name('payment.process');
    // Route::post('/complete-payment', [UserImmeubleController::class, 'completePayment'])->name('completePayment');

    // //show details

    // Route::get('/immeubles/{id}/details', [ImmeubleController::class, 'detail'])->name('user.immeubles.details');


});
// Stripe Payment Routes
// Route::get('/pay-with-card', [PayementController::class, 'showStripeForm'])->name('stripe.form');
// Route::post('/process-payment', [PayementController::class, 'process'])->name('stripe.process');


Route::get('/immeubles/{id}/details', [ImmeubleController::class, 'detail'])->name('user.immeubles.details');
Route::get('/immeubles/reserve/{id}', [UserImmeubleController::class, 'reserve'])->name('user.immeubles.reserve');

// Payment Routes
Route::get('/pay-with-card', [PayementController::class, 'showStripeForm'])->name('stripe.form');
//Route::post('/process-payment', [PayementController::class, 'process'])->name('stripe.process');
Route::post('/complete-payment', [UserImmeubleController::class, 'completePayment'])->name('completePayment');
Route::post('/immeubles/payment', [PayementController::class, 'process'])->name('payment.process');
Route::get('/payment/success', [PayementController::class, 'successPage'])->name('payment.success');

Route::get('/process-payment', [PayementController::class, 'showForm'])->name('payment.form');
Route::post('/process-payment', [PayementController::class, 'process'])->name('payment.process');


Route::post('/process-payment', [PayementController::class, 'process'])->name('payment.process'); // Process payment here
Route::get('/process-payment', [PayementController::class, 'showForm'])->name('payment.form');






// Route::get('/blockchainpayement', function () {
//     return view('payments.blockchain-form');
// });



// Blockchain Payment Route
//Route::get('/blockchain-payment', [BlockchainController::class, 'showBlockchainForm'])->name('blockchain.form');
Route::post('/send-ether', [BlockchainController::class, 'sendEther'])->name('blockchain.send');
Route::get('/blockchain-payment/{dynamicAmount}', [BlockchainController::class, 'showBlockchainForm'])->name('blockchain.form');

// Welcome email route
Route::post('/send-welcome-email', [EmailController::class, 'sendWelcomeEmail']);

// Logout route
Route::post('/logout', function() {
    Auth::logout();
    return redirect('/home');
})->name('logout');

// Success page after purchase
Route::get('/purchase-success', function () {
    return view('purchase-success');
});
Route::get('/payment-success', function () {
    return view('success');
})->name('payment.success');
Route::get('/payment-error', function () {
    return view('failed');
})->name('payment.failed');
