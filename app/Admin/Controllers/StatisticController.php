<?php

namespace  App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Immeuble; // Assurez-vous d'importer le modèle Immeuble

class StatisticController extends Controller
{
    public function index()
    {
        // Total des Utilisateurs
        $totalUsers = User::count();
    
        // Répartition des Utilisateurs par Domaine de Mail
        $mailDomainCounts = User::selectRaw('SUBSTRING_INDEX(email, "@", -1) as domain, COUNT(*) as count')
            ->groupBy('domain')
            ->pluck('count', 'domain');
    
        // Nombre d'Utilisateurs Par Mois
        $monthlyUserCounts = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    
        // Statistiques sur les Numéros de Téléphone
        $phonePrefixCounts = User::selectRaw('SUBSTRING(phone, 1, 4) as prefix, COUNT(*) as count')
            ->groupBy('prefix')
            ->pluck('count', 'prefix');
    
        // Calcul des statistiques pour les immeubles
        $totalImmeubles = Immeuble::count(); // Nombre total d'immeubles
    
        // Nombre d'immeubles par ville
        $immeublesByCity = Immeuble::select('ville', \DB::raw('count(*) as total'))
            ->groupBy('ville')
            ->pluck('total', 'ville')
            ->toArray();
    
        // Autres statistiques sur les immeubles
        $totalRooms = Immeuble::sum('rooms'); // Somme totale des pièces
        $averagePrice = Immeuble::average('price'); // Prix moyen des immeubles
        $maxPrice = Immeuble::max('price'); // Prix le plus élevé
        $minPrice = Immeuble::min('price'); // Prix le plus bas
        $totalAirConditioning = Immeuble::where('air_conditioning', true)->count(); // Nombre d'immeubles avec climatisation
        $totalHeating = Immeuble::where('heating', true)->count(); // Nombre d'immeubles avec chauffage
    
        // Préparer les données pour les graphiques
        $cities = array_keys($immeublesByCity);
        $cityCounts = array_values($immeublesByCity);
    
        return view('admin.statistics', [
            'totalUsers' => $totalUsers,
            'mailDomainCounts' => $mailDomainCounts,
            'monthlyUserCounts' => $monthlyUserCounts,
            'phonePrefixCounts' => $phonePrefixCounts,
            'totalImmeubles' => $totalImmeubles,
            'totalRooms' => $totalRooms,
            'averagePrice' => $averagePrice,
            'maxPrice' => $maxPrice,
            'minPrice' => $minPrice,
            'totalAirConditioning' => $totalAirConditioning,
            'totalHeating' => $totalHeating,
            'cities' => $cities,
            'cityCounts' => $cityCounts,
        ]);
    }

}