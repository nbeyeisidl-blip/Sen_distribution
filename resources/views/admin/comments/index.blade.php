@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Gestion des commentaires</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Note</th>
                        <th>Commentaire</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user ? $comment->user->name : 'Anonyme' }}</td>
                            <td>
                                <strong>{{ $comment->product ? $comment->product->name : 'Produit supprimé' }}</strong>
                            </td>
                            <td>
                                <span class="text-warning">
                                    ★ {{ $comment->rating }}/5
                                </span>
                            </td>
                            <td>{{ Str::limit($comment->content, 60) }}</td>
                            <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Aucun commentaire trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $comments->links() }}
    </div>
</div>
@endsection