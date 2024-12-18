<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tunisiemaison - Accueil</title>
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
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/M.png') }}" alt="Logo">
                    Tunisiemaison
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <!-- Carrousel -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/5.png') }}" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/2.jpg') }}" class="d-block w-100" alt="Slide 2">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/3.jpg') }}" class="d-block w-100" alt="Slide 3">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/4.jpg') }}" class="d-block w-100" alt="Slide 4">
                        <div class="carousel-caption">
                            <h5>Bienvenue chez Maison Tunisie</h5>
                        </div>
                    </div>
                </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <section class="agency-description mt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2>À propos de Tunisiemaison</h2>
                <p>Chez Tunisiemaison, nous sommes spécialisés dans la vente et la location de maisons à travers la Tunisie. Nous nous engageons à offrir des services de haute qualité pour vous aider à trouver le bien immobilier qui correspond à vos besoins. Que vous cherchiez une maison à acheter ou à louer, notre équipe est là pour vous guider à chaque étape du processus.</p>
                <p>Notre expertise et notre connaissance approfondie du marché local nous permettent de vous offrir les meilleures options disponibles. Nous mettons un point d'honneur à satisfaire nos clients en leur fournissant des informations précises et des conseils personnalisés.</p>
                <p>Découvrez dès maintenant notre large sélection d'immeubles et trouvez la maison de vos rêves avec Tunisiemaison.</p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('images/7.jpg') }}" alt="Image de l'agence" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

@if(isset($immeubles) && $immeubles->count() > 0)
    <div class="immeubles-list mt-5">
        @foreach ($immeubles->take(3) as $immeuble)
            <div class="immeuble-card">
            @if($immeuble->picture)
                        <img src="{{ asset('uploads/' . $immeuble->picture) }}" class="card-img-top" alt="{{ $immeuble->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Placeholder">
                    @endif                <div class="card-body">
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
        </main>
           <a href="{{ route('list') }}" class="btn btn-primary">See the rest of the real estates</a>

        <footer class="footer">
            <div class="footer-description">
                <p>
                    <strong>Tunisiemaison</strong> vous accompagne à chaque étape de votre recherche de maison, offrant une large sélection de biens à travers la Tunisie.
                    Que vous cherchiez à acheter ou à louer, notre équipe dévouée est là pour vous fournir des conseils personnalisés et un service exceptionnel.
                    Découvrez notre sélection et trouvez la maison de vos rêves avec Tunisiemaison.
                </p>
            </div>
            <div class="footer-contact">
                <p>Contactez-nous :</p>
                <p><a href="mailto:contact@tunisiemaison.com">contact@tunisiemaison.com</a></p>
                <div class="footer-icons">
                    <a href="https://www.facebook.com/tunisiemaison" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                    <a href="https://www.instagram.com/tunisiemaison" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                </div>
                <div class="footer-divider"></div>
                <div class="footer-copyright">
                    © 2024 Tunisiemaison. Tous droits réservés.
                </div>
            </div>
        </footer>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
