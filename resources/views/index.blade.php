@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="{{ route('user.immeubles.index') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par ville" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Rechercher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($immeubles as $immeuble)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($immeuble->picture)
                        <img src="{{ asset('uploads/' . $immeuble->picture) }}" class="card-img-top" alt="{{ $immeuble->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Placeholder">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $immeuble->name }}</h5>
                        <p class="card-text">{{ $immeuble->description }}</p>
                        <p class="card-text"><strong>Prix:</strong> {{ $immeuble->price }} TND</p>
                        <p class="card-text"><strong>Ville :</strong> {{ $immeuble->ville }}</p>
                        <p class="card-text"><strong>Nombre de chambre :</strong> {{ $immeuble->rooms }}</p>
                        <a href="{{ route('user.immeubles.reserve', $immeuble->id) }}" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
