<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f7;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 10px 0;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2em;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            text-align: center;
            color: #0056b3;
        }
        .statistics-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .statistics-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }
        .statistic-item {
            flex: 1 1 calc(25% - 20px);
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s;
        }
        .statistic-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .statistic-item strong {
            display: block;
            font-size: 1.4em;
            margin-bottom: 10px;
            color: #007bff;
        }
        .statistic-item p {
            margin: 0;
            font-size: 1.2em;
            color: #555;
        }
        .chart-container {
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }
        canvas {
            width: 100% !important;
            height: 400px;
        }
        @media (max-width: 768px) {
            .statistic-item {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
        <!-- <li><a href="{{ route('admin.home') }}">Accueil</a></li> -->
        <li><a href="{{ route('admin.immeuble.index') }}">Immobilier</a></li>
          <!--  <li><a href="{{ route('admin.statistics.index') }}">Statistiques</a></li> -->
        </ul>
    </div>
    <div class="content">
        <div class="container">
            <h1>Statistiques des Immeubles et des Utilisateurs</h1>
            <div class="statistics-container">
                <!-- Statistiques des Immeubles et des Utilisateurs -->
                <div class="statistics-row">
                    <div class="statistic-item">
                        <strong>Total des Immeubles</strong>
                        <p>{{ $totalImmeubles }}</p>
                    </div>
                    <div class="statistic-item">
                        <strong>Total des Pièces</strong>
                        <p>{{ $totalRooms }}</p>
                    </div>
                    <div class="statistic-item">
                        <strong>Prix Moyen des Immeubles</strong>
                        <p>{{ number_format($averagePrice, 2) }} TND</p>
                    </div>
                    <div class="statistic-item">
                        <strong>Prix le Plus Élevé</strong>
                        <p>{{ number_format($maxPrice, 2) }} TND</p>
                    </div>
                    <div class="statistic-item">
                        <strong>Prix le Plus Bas</strong>
                        <p>{{ number_format($minPrice, 2) }} TND</p>
                    </div>
                    <div class="statistic-item">
                        <strong>Nombre d'Immeubles avec Climatisation</strong>
                        <p>{{ $totalAirConditioning }}</p>
                    </div>
                    <div class="statistic-item">
                        <strong>Nombre d'Immeubles avec Chauffage</strong>
                        <p>{{ $totalHeating }}</p>
                    </div>
                    <div class="statistic-item">
                        <strong>Total des Utilisateurs</strong>
                        <p>{{ $totalUsers }}</p>
                    </div>
                </div>

                <!-- Graphique pour les immeubles -->
                <div class="chart-container">
                    <strong>Nombre d'Immeubles par Ville</strong>
                    <canvas id="cityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Graphique des immeubles
        var ctx = document.getElementById('cityChart').getContext('2d');
        var cityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($cities),
                datasets: [{
                    label: 'Nombre d\'Immeubles',
                    data: @json($cityCounts),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
