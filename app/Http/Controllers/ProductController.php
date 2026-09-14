<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importation du modèle Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Récupérer tous les produits depuis la base de données
        $products = Product::all();

        // Envoyer la variable $products à la vue blade
        return view('welcome', compact('products'));
    }
}