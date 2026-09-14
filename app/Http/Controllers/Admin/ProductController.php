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
    // 1. Validation des champs
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // 2. Instanciation obligatoire du modèle Product
    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->category_id = $request->category_id ?? null;

    // 3. Gestion du téléversement de l'image
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Sauvegarde dans public/uploads/products
        $file->move(public_path('images/products'), $filename);
        
        // Affectation du nom de fichier à l'objet instancié
        $product->image = $filename;
    }

    // 4. Sauvegarde en base de données
    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès !');
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