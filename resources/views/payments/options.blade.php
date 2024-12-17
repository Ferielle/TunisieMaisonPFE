@extends('layouts.app')

@section('content')
<div class="payment-options">
    <h5>Choose Your Payment Method:</h5>
    <a href="{{ route('stripe.form') }}" class="btn btn-primary">Pay with Credit Card</a>
    <a href="{{ route('blockchain.form') }}" class="btn btn-secondary">Pay with Blockchain</a>
</div>
@endsection
