@extends('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                @if(!empty($immeuble->pictures) && is_array($immeuble->pictures))
                    <div id="carouselExampleControls" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach($immeuble->pictures as $index => $picture)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Placeholder">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Placeholder">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $immeuble->name }}</h5>
                    <p class="card-text">{{ $immeuble->description }}</p>
                    <p class="card-text"><strong>Price:</strong> {{ $immeuble->price }} TND</p>
                    <p class="card-text"><strong>Location:</strong> {{ $immeuble->ville }}</p>

                    <div class="row">
                        <div class="col-6">
                            <p class="card-text">
                                <i class="fas fa-bed"></i> Rooms: {{ $immeuble->rooms }}
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="card-text">
                                <i class="fas fa-restroom"></i> Toilets: {{ $immeuble->toilets }}
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <p class="card-text">
                                <i class="fas fa-snowflake"></i> Air Conditioning:
                                {{ $immeuble->air_conditioning ? 'Yes' : 'No' }}
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="card-text">
                                <i class="fas fa-fire"></i> Heating:
                                {{ $immeuble->heating ? 'Yes' : 'No' }}
                            </p>
                        </div>
                    </div>

                    <div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Owner Information</h5>
        <p class="card-text"><strong>Name:</strong> {{ $immeuble->owner_name }}</p>
        <p class="card-text"><strong>Phone:</strong> {{ $immeuble->owner_phone ?? 'Not provided' }}</p> <!-- assuming phone is an optional field -->
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</div>
<div>
<div class="payment-options">
    <h5>Choose Payment Method:</h5>
    <a href="{{ route('blockchain.form', ['dynamicAmount' => $immeuble->price]) }}" class="btn btn-primary">Pay with Bitcoin</a>
    <input type="hidden" id="product-amount" value="{{ $immeuble->price }}">
    <a href="{{ route('stripe.form', ['amount' => $immeuble->price]) }}" class="btn btn-primary">Pay with Credit Card</a>

</div>
<footer>
<component is="script">
<script src="https://cdn.jsdelivr.net/npm/ethers@5.7.2/dist/ethers.umd.min.js"></script>
<script type="text/javascript" src="{{ asset('js/stripe.js') }}"></script>
<script src="https://js.stripe.com/v3/"></script>

</component>
</footer>


</div>

<style>
    .my-custom-background {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
    }

    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.5rem;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .carousel-item img {
        border-radius: 10px;
    }
</style>
``
