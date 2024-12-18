<!-- resources/views/list.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Liste des Immeubles</h1>

    @if($immeubles->count() > 0)
        <div class="immeubles-list mt-5">
            @foreach ($immeubles as $immeuble)
                <div class="immeuble-card">
                    @if($immeuble->picture)
                        <img src="{{ asset('uploads/' . $immeuble->picture) }}" class="card-img-top" alt="{{ $immeuble->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Placeholder">
                    @endif
                    <div class="card-body">
                        <h3>{{ $immeuble->name }}</h3>
                        <p><strong>Adresse :</strong> {{ $immeuble->address }}</p>
                        <p><strong>Prix :</strong> {{ number_format($immeuble->price, 2) }} TND</p>
                        <p>{{ $immeuble->description }}</p>
                    <a href="{{ route('user.immeubles.reserve', $immeuble->id) }}" class="btn-reserve">Réserver</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">Aucun immeuble trouvé.</p>
    @endif
@endsection


<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f8f9fa;
        color: #343a40;
    }
    .hero-section {
        background-color: #007bff;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    .hero-section h1 {
        font-size: 3rem;
        margin: 0;
    }
    .navbar, .btn-reserve {
        background-color: #007bff;
        color: white;
    }
    .navbar-brand img {
        height: 50px; /* Ajustez la hauteur du logo */
        width: auto;  /* Conserver le ratio d'aspect */
    }
    .btn-reserve:hover {
        background-color: #0056b3;
    }
    .immeubles-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
    }
    .immeuble-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s;
    }
    .immeuble-card:hover {
        transform: translateY(-5px);
    }
    .carousel-caption {
        bottom: 20px;
        text-align: center;
    }
    .carousel-caption h5 {
        font-size: 2rem;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
/* Aligner légèrement à gauche la section "À propos de Tunisiemaison" */
.agency-description {
background-color: #f8f9fa;
padding: 40px 0;
margin-left: 10px; /* Ajouter une marge à gauche */
}

.immeubles-list {
display: flex;
flex-wrap: wrap;
gap: 20px; /* Espace entre les cartes */
justify-content: space-around; /* Centre les cartes et ajoute de l'espace autour */
}

.immeuble-card {
width: 30%; /* Ajustez la taille selon vos besoins */
border: 1px solid #ddd;
border-radius: 8px;
overflow: hidden;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
transition: transform 0.3s;
}

.immeuble-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}


.immeuble-card .card-body {
padding: 15px;
}

.immeuble-card h3 {
margin-top: 0;
font-size: 1.25rem;
}

.immeuble-card p {
margin: 0.5rem 0;
}

.btn-reserve {
display: inline-block;
padding: 10px 15px;
background-color: #007bff;
color: #fff;
text-decoration: none;
border-radius: 5px;
text-align: center;
transition: background-color 0.3s;
}

.btn-reserve:hover {
background-color: #0056b3;
}

.immeuble-card:hover {
transform: scale(1.05); /* Agrandit légèrement la carte au survol */
}
    .footer {
        background-color: white;
        color: Black;
        padding: 40px 20px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 20px;
    }
    .footer p {
        margin: 0;
        line-height: 1.6;
    }
    .footer-description {
        max-width: 600px;
        flex: 1;
    }
    .footer-contact {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        min-width: 250px;
    }
    .footer-icons {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }
    .footer-icons a {
        color: Black;
        transition: color 0.3s ease;
    }
    .footer-icons a:hover {
        color: #007bff;
    }
    .footer-contact p {
        margin-bottom: 5px;
    }
    .footer-contact a {
        color: #007bff;
        text-decoration: none;
    }
    .footer-contact a:hover {
        text-decoration: underline;
    }
    .footer-divider {
        height: 1px;
        background-color: #444;
        margin: 20px 0;
        width: 100%;
    }
    .footer-copyright {
        text-align: right;
        font-size: 0.9rem;
        color: #aaa;
        margin-top: 10px;
    }

</style>
