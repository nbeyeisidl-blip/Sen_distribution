<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'product_id' => $product->id,
            'user_id'    => Auth::id(), // ou null si les avis anonymes sont autorisés
            'rating'     => $request->rating,
            'content'    => $request->content,
        ]);

        return back()->with('success', 'Votre avis a été publié avec succès !');
    }
}
