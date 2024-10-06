<!-- resources/views/accueil.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Immeubles à Tunis</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Assurez-vous que le fichier CSS est bien lié -->
    <style>
        /* Styles généraux */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        header p {
            margin: 10px 0 0;
        }
        .immeubles-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .immeuble-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .immeuble-card:hover {
            transform: translateY(-5px);
        }
        .immeuble-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .immeuble-card h3 {
            font-size: 1.5rem;
            margin: 15px 20px;
            color: #007bff;
        }
        .immeuble-card p {
            margin: 0 20px 10px;
            line-height: 1.6;
        }
        .btn-reserve {
            display: block;
            width: calc(100% - 40px);
            margin: 15px 20px;
            padding: 10px 0;
            background-color: #28a745;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-reserve:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenue sur Immeubles à Tunis</h1>
        <p>Découvrez les meilleurs immeubles disponibles à la réservation à Tunis.</p>
    </header>
    <div class="container">
        <div class="immeubles-list">
            @foreach ($immeubles as $immeuble)
                <div class="immeuble-card">
                    <img src="{{ asset('storage/' . $immeuble->picture) }}" alt="Image de {{ $immeuble->name }}">
                    <h3>{{ $immeuble->name }}</h3>
                    <p><strong>Adresse :</strong> {{ $immeuble->address }}</p>
                    <p><strong>Prix :</strong> {{ number_format($immeuble->price, 2) }} TND</p>
                    <p>{{ $immeuble->description }}</p>
                    <a href="{{ route('reserve', $immeuble->id) }}" class="btn-reserve">Réserver</a>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
