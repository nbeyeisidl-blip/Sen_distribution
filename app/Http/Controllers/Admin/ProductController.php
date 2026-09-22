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

       return view('admin.products.index', compact('products'));
        
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
        'name'            => 'required|string|max:255',
        'price'           => 'required|numeric|min:0',
        'stock'           => 'required|integer|min:0',
        'category_id'     => 'required|exists:categories,id',
        'size'            => 'nullable|string|max:50',
        'color'           => 'nullable|string|max:50',
        'gender'          => 'required|in:homme,femme,mixte,enfant',
        'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'external_source' => 'nullable|string|max:100',
        'external_ref'    => 'nullable|string|max:255',
        'description'     => 'nullable|string',
        'image_url' => 'nullable|url',
    ]);

    // 2. Traitement et upload de l'image (avant la création)
    $imagePath = null;

    // Si l'administrateur téléverse un fichier local
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    } 
    // Sinon, si une URL Google/externe est renseignée
    elseif ($request->filled('image_url')) {
        $imagePath = $request->image_url;
    }
    // 3. Enregistrement unique en base de données
    Product::create([
        'name'            => $request->name,
        'description'     => $request->description,
        'price'           => $request->price,
        'stock'           => $request->stock,
        'category_id'     => $request->category_id,
        'external_source' => $request->external_source,
        'external_ref'    => $request->external_ref,
        'size'            => $request->size,
        'color'           => $request->color,
        'gender'          => $request->gender,
       'image'       => $imagePath,// Reçoit le nom du fichier ou null
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès !');
}

    /**
     * Formulaire de modification
     */
   // Afficher le formulaire de modification
public function edit(Product $product)
{
    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}

// Mettre à jour le produit
public function update(Request $request, Product $product)
{
    $request->validate([
        'name'            => 'required|string|max:255',
        'price'           => 'required|numeric|min:0',
        'stock'           => 'required|integer|min:0',
        'category_id'     => 'required|exists:categories,id',
        'size'            => 'nullable|string|max:50',
        'color'           => 'nullable|string|max:50',
        'gender'          => 'required|in:homme,femme,mixte,enfant',
        'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'external_source' => 'nullable|string|max:100',
        'external_ref'    => 'nullable|string|max:255',
        'description'     => 'nullable|string',
        'image_url' => 'nullable|url',
    ]);

    // Gestion de l'image si une nouvelle image est téléversée
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
            unlink(public_path('images/products/' . $product->image));
        }

        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/products'), $filename);
        $product->image = $filename;
    }

    $product->update([
        'name'            => $request->name,
        'description'     => $request->description,
        'price'           => $request->price,
        'stock'           => $request->stock,
        'category_id'     => $request->category_id,
        'external_source' => $request->external_source,
        'external_ref'    => $request->external_ref,
        'size'            => $request->size,
        'color'           => $request->color,
        'gender'          => $request->gender,
        'image'           => $product->image,
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès !');
}

// Supprimer un produit
public function destroy(Product $product)
{
    if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
        unlink(public_path('images/products/' . $product->image));
    }

    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès !');
}
   
}