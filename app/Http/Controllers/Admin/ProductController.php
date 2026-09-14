<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Liste des produits
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Product::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.products.index',
            compact('products', 'search')
        );
    }

    /**
     * Formulaire d'ajout
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.products.create',
            compact('categories')
        );
    }

    /**
     * Enregistrer un produit
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | ENREGISTREMENT DE L'IMAGE
        |--------------------------------------------------------------------------
        */

      // Lors de la création d'un produit (méthode store)
if ($request->hasFile('image')) {
    $image = $request->file('image');
    // Générer un nom unique pour éviter les doublons
    $imageName = time() . '_' . $image->getClientOriginalName();
    
    // Déplacer le fichier dans le dossier public/images/products
    $image->move(public_path('images/products'), $imageName);
    
    // Enregistrer seulement le nom du fichier dans la BDD (ex: "1726270000_dior.jpg")
    $product->image = $imageName;
}
$product->save();

        /*
        |--------------------------------------------------------------------------
        | CRÉATION DU PRODUIT
        |--------------------------------------------------------------------------
        */

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produit ajouté avec succès.'
            );
    }

    /**
     * Formulaire de modification
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }

    /**
     * Modifier un produit
     */
   public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'category_id' => 'nullable|exists:categories,id',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
    ]);

    // Mise à jour des données textuelles
    $product->name = $request->name;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->category_id = $request->category_id;
    $product->description = $request->description;

    // Gestion du fichier image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe dans le dossier
        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        
        // Déplacer l'image vers le dossier public
        $image->move(public_path('images/products'), $imageName);

        // Assigner le nom de fichier généré au champ
        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'Produit modifié avec succès.');
}

    /**
     * Supprimer un produit
     */
    public function destroy(Product $product)
    {
        /*
        |--------------------------------------------------------------------------
        | SUPPRIMER L'IMAGE
        |--------------------------------------------------------------------------
        */

        if ($product->image) {
            Storage::disk('public')
                ->delete($product->image);
        }

        /*
        |--------------------------------------------------------------------------
        | SUPPRIMER LE PRODUIT
        |--------------------------------------------------------------------------
        */

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Produit supprimé avec succès.'
            );
    }
}