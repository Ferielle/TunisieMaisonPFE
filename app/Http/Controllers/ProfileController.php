<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Afficher le profil
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // Afficher le formulaire d'édition du profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Mettre à jour le profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation des données
        $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'firstname' => $request->input('firstname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
    }
}
