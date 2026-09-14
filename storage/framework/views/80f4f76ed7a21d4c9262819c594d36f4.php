

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Nouvelle Vente</h1>
            <p class="text-muted small mb-0">Interface Point de Vente (POS) - SEN DISTRIBUTION</p>
        </div>
        <a href="<?php echo e(route('cashier.dashboard')); ?>" class="btn btn-outline-secondary fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Tableau de bord
        </a>
    </div>

    <?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

    <form action="<?php echo e(route('cashier.sales.store')); ?>" method="POST" id="saleForm">
        <?php echo csrf_field(); ?>

        <div class="row g-4">

            
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small">Client</label>
                            <select name="client_id" class="form-select form-select-lg" required>
                                <option value="">Sélectionner un client...</option>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($client->id); ?>">
                                        <?php echo e($client->name ?? $client->nom); ?> (<?php echo e($client->phone ?? 'Pas de numéro'); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        
                        <div class="table-responsive mb-4">
                            <table class="table align-middle" id="cartTable">
                                <thead class="table-light small text-muted">
                                    <tr>
                                        <th>Produit</th>
                                        <th style="width: 120px;">Prix U.</th>
                                        <th style="width: 110px;">Qté</th>
                                        <th style="width: 130px;">Total</th>
                                        <th style="width: 50px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="cartBody">
                                    <tr id="emptyCartRow">
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="bi bi-cart-x fs-3 d-block mb-2"></i>
                                            Panier vide. Cliquez sur un produit dans le catalogue à droite.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="bg-light p-3 rounded mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Sous-total :</span>
                                <strong id="subtotalDisplay">0 FCFA</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Remise (FCFA) :</span>
                                <input type="number" name="discount" id="discountInput" class="form-control form-control-sm text-end w-25" value="0" min="0" oninput="calculateTotals()">
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between fs-4 fw-bold text-primary">
                                <span>Total net :</span>
                                <span id="totalDisplay">0 FCFA</span>
                            </div>
                        </div>

                        
                        <div class="row g-3">
                            <div class="col-12 mb-2">
                                <label class="form-label fw-bold text-dark small">Mode de paiement</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check flex-fill border p-3 rounded">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payCash" value="espèces" checked>
                                        <label class="form-check-label fw-bold" for="payCash">Espèces</label>
                                    </div>
                                    <div class="form-check flex-fill border p-3 rounded">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payWave" value="wave">
                                        <label class="form-check-label fw-bold" for="payWave">Wave</label>
                                    </div>
                                    <div class="form-check flex-fill border p-3 rounded">
                                        <input class="form-check-input" type="radio" name="payment_method" id="payOM" value="orange_money">
                                        <label class="form-check-label fw-bold" for="payOM">Orange Money</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <a href="<?php echo e(route('cashier.dashboard')); ?>" class="btn btn-outline-secondary w-100 py-2 fw-bold">Annuler</a>
                            </div>
                            <div class="col-6">
                               <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" id="submitBtn" disabled>
    <i class="bi bi-check-circle me-1"></i> Valider la vente
</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" id="searchProduct" class="form-control border-start-0 bg-light" placeholder="Rechercher un produit..." onkeyup="filterProducts()">
                        </div>
                    </div>
                    <div class="card-body overflow-auto" style="max-height: 550px;">
                        <div class="list-group list-group-flush" id="productList">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" 
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 product-item"
                                        data-name="<?php echo e(strtolower($product->name ?? $product->nom)); ?>"
                                        onclick="addToCart(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->name ?? $product->nom)); ?>', <?php echo e($product->price); ?>, <?php echo e($product->stock); ?>)">
                                    <div>
                                        <div class="fw-bold text-dark"><?php echo e($product->name ?? $product->nom); ?></div>
                                        <small class="text-muted">En stock: <?php echo e($product->stock); ?></small>
                                    </div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold fs-6">
                                        <?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA
                                    </span>
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    let cart = {};

    function addToCart(id, name, price, maxStock) {
        if (cart[id]) {
            if (cart[id].quantity < maxStock) {
                cart[id].quantity++;
            } else {
                alert('Stock maximal disponible atteint pour ce produit.');
                return;
            }
        } else {
            cart[id] = { id: id, name: name, price: price, quantity: 1, maxStock: maxStock };
        }
        renderCart();
    }

    function removeFromCart(id) {
        delete cart[id];
        renderCart();
    }

    function updateQuantity(id, qty) {
        qty = parseInt(qty);
        if (qty > cart[id].maxStock) {
            alert('Stock insuffisant');
            cart[id].quantity = cart[id].maxStock;
        } else if (qty <= 0 || isNaN(qty)) {
            removeFromCart(id);
            return;
        } else {
            cart[id].quantity = qty;
        }
        renderCart();
    }

    function renderCart() {
        const cartBody = document.getElementById('cartBody');
        const submitBtn = document.getElementById('submitBtn');
        const items = Object.values(cart);

        // Si le panier est vide
        if (items.length === 0) {
            cartBody.innerHTML = `
                <tr id="emptyCartRow">
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="bi bi-cart-x fs-3 d-block mb-2"></i>
                        Panier vide. Cliquez sur un produit dans le catalogue à droite.
                    </td>
                </tr>`;
            if (submitBtn) {
                submitBtn.disabled = true; // RESTE DÉSACTIVÉ SI VIDE
            }
            calculateTotals();
            return;
        }

        // SI LE PANIER CONTIENT AU MOINS UN PRODUIT : ACTIVER LE BOUTON
        if (submitBtn) {
            submitBtn.disabled = false;
        }

        let html = '';
        items.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            html += `
                <tr>
                    <td>
                        <div class="fw-bold text-dark small">${item.name}</div>
                        <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                        <input type="hidden" name="items[${index}][price]" value="${item.price}">
                        <input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">
                    </td>
                    <td class="small">${item.price.toLocaleString('fr-FR')} FCFA</td>
                    <td>
                        <input type="number" class="form-control form-control-sm text-center" 
                               value="${item.quantity}" min="1" max="${item.maxStock}" 
                               onchange="updateQuantity(${item.id}, this.value)">
                    </td>
                    <td class="fw-bold text-primary small">${itemTotal.toLocaleString('fr-FR')} FCFA</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger border-0" onclick="removeFromCart(${item.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>`;
        });

        cartBody.innerHTML = html;
        calculateTotals();
    }

    function calculateTotals() {
        let subtotal = 0;
        Object.values(cart).forEach(item => {
            subtotal += item.price * item.quantity;
        });

        const discountInput = parseInt(document.getElementById('discountInput').value) || 0;
        const total = Math.max(0, subtotal - discountInput);

        document.getElementById('subtotalDisplay').innerText = subtotal.toLocaleString('fr-FR') + ' FCFA';
        document.getElementById('totalDisplay').innerText = total.toLocaleString('fr-FR') + ' FCFA';
    }

    function filterProducts() {
        const query = document.getElementById('searchProduct').value.toLowerCase();
        const items = document.querySelectorAll('.product-item');

        items.forEach(item => {
            const name = item.getAttribute('data-name');
            item.style.display = name.includes(query) ? 'flex' : 'none';
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cashier.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/cashier/sales/create.blade.php ENDPATH**/ ?>