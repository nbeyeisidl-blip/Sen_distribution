<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Afficher la liste de tous les commentaires
    public function index()
    {
        $comments = Comment::with(['product', 'user'])->latest()->paginate(15);
        
        return view('admin.comments.index', compact('comments'));
    }

    // Supprimer un commentaire inapproprié
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Commentaire supprimé avec succès.');
    }
}