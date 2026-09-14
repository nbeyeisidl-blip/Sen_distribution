<div class="product-list">
    @forelse ($products as $product)
        <div class="product-card">
            <h3>{{ $product->nom }}</h3>
            <p>{{ $product->description }}</p>
            <span>Prix : {{ $product->prix }} FCFA</span>
        </div>
    @empty
        <p>Aucun produit disponible pour le moment.</p>
    @endforelse
</div>