<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Liste des fournisseurs
     */
    public function index()
    {
        $fournisseurs = Fournisseur::latest()->paginate(10);

        return view(
            'admin.fournisseurs.index',
            compact('fournisseurs')
        );
    }

    /**
     * Formulaire d'ajout
     */
    public function create()
    {
        return view('admin.fournisseurs.create');
    }

    /**
     * Enregistrer
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'entreprise' => 'nullable|string|max:255',
        ], [
            'nom.required' => 'Le nom du fournisseur est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
        ]);

        Fournisseur::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'entreprise' => $request->entreprise,
        ]);

        return redirect()
            ->route('admin.fournisseurs.index')
            ->with(
                'success',
                'Fournisseur ajouté avec succès.'
            );
    }

    /**
     * Afficher un fournisseur
     */
    public function show(Fournisseur $fournisseur)
    {
        return view(
            'admin.fournisseurs.show',
            compact('fournisseur')
        );
    }

    /**
     * Formulaire modification
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view(
            'admin.fournisseurs.edit',
            compact('fournisseur')
        );
    }

    /**
     * Modifier
     */
    public function update(
        Request $request,
        Fournisseur $fournisseur
    ) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'entreprise' => 'nullable|string|max:255',
        ]);

        $fournisseur->update([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'entreprise' => $request->entreprise,
        ]);

        return redirect()
            ->route('admin.fournisseurs.index')
            ->with(
                'success',
                'Fournisseur modifié avec succès.'
            );
    }

    /**
     * Supprimer
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();

        return redirect()
            ->route('admin.fournisseurs.index')
            ->with(
                'success',
                'Fournisseur supprimé avec succès.'
            );
    }
}