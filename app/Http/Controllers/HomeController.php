<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immeuble;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Exige l'authentification pour toutes les méthodes sauf 'index'
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProperties()
    {
        $properties = Immeuble::all(); // Assurez-vous que 'Immeuble' est bien le modèle utilisé

        // Définir un tableau avec les chemins des 4 images statiques
        $staticImages = [
            asset('images/1.png'),
            asset('images/2.jpg'),
            asset('images/3.jpg'),
            asset('images/4.jpg')
        ];

        // Remplacer l'image de chaque propriété par une des images statiques de manière aléatoire
        foreach ($properties as $property) {
            $property->image_url = $staticImages[array_rand($staticImages)];
        }

        return response()->json($properties);
    }

    /**
     * Display the index view.
     */

     public function index()
     {
         // Récupérer les immeubles depuis la base de données
         $immeubles = Immeuble::all();

         // Passer les immeubles à la vue 'index'
         return view('home', compact('immeubles'));

     }



     public function list()
{
    $immeubles = Immeuble::all();
    return view('list', compact('immeubles'));
}


}
