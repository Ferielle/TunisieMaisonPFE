<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserImmeubleController;
use App\Admin\Controllers\ImmeubleController;


// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/index', [HomeController::class, 'index'])->name('index');

//Route::get('/index', [HomeController::class, 'index'])->name('index');
//Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/', function () {
    return redirect('/home');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('home'); // Utilisez le fichier home.blade.php
// });

Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
//Route::get('/', [HomeController::class, 'index'])->name('home');
// Route pour afficher le formulaire d'édition du profil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Route pour mettre à jour le profil
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


// Route pour afficher le formulaire de demande de réinitialisation de mot de passe
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Route pour envoyer le lien de réinitialisation de mot de passe
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route pour afficher le formulaire de réinitialisation de mot de passe
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route pour réinitialiser le mot de passe
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Assure-toi que la route est protégée par le middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/immeubles', [UserImmeubleController::class, 'index'])->name('user.immeubles.index');
    // Ajoute d'autres routes protégées ici si nécessaire
});
Route::get('/immeubles/reserve/{id}', [UserImmeubleController::class, 'reserve'])->name('user.immeubles.reserve');
Route::get('/reserve/{id}', [UserImmeubleController::class, 'reserve'])->name('reserve');
Route::post('/immeubles/payment', [PaymentController::class, 'process'])->name('payment.process');
Route::post('/complete-payment', [UserImmeubleController::class, 'completePayment'])->name('completePayment');

//show details

Route::get('/immeubles/{id}/details', [ImmeubleController::class, 'detail'])->name('user.immeubles.details');


Route::post('/logout', function() {
    Auth::logout();
    return redirect('/home'); // Redirige vers /home après la déconnexion
})->name('logout');
