

<?php $__env->startSection('title', 'Tableau de bord Admin - SEN DISTRIBUTION'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-3">
    
    <div class="row g-3 mb-4">
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                <small class="text-muted fw-semibold">Produits</small>
                <div class="d-flex align-items-baseline mt-2">
                    <h2 class="fw-bold text-dark m-0 me-2"><?php echo e($totalProducts ?? 245); ?></h2>
                </div>
                <small class="text-muted mt-1" style="font-size: 12px;">Total produits</small>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                <small class="text-muted fw-semibold">Stock</small>
                <div class="d-flex align-items-baseline mt-2">
                    <h2 class="fw-bold text-dark m-0 me-2"><?php echo e($productsInStock ?? 128); ?></h2>
                </div>
                <small class="text-muted mt-1" style="font-size: 12px;">Produits en stock</small>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                <small class="text-muted fw-semibold">Ventes</small>
                <div class="d-flex align-items-baseline mt-2">
                    <h2 class="fw-bold text-dark m-0 me-2" style="font-size: 1.6rem;"><?php echo e(number_format($totalSalesAmount ?? 8750000, 0, ',', ' ')); ?> FCFA</h2>
                </div>
                <small class="text-muted mt-1" style="font-size: 12px;">Montant total</small>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                <small class="text-muted fw-semibold">Commandes</small>
                <div class="d-flex align-items-baseline mt-2">
                    <h2 class="fw-bold text-dark m-0 me-2"><?php echo e($pendingOrders ?? 12); ?></h2>
                </div>
                <small class="text-muted mt-1" style="font-size: 12px;">En attente</small>
            </div>
        </div>
    </div>

    
    <div class="row g-4 mb-4">
        
        <div class="col-12 col-lg-7 col-xl-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold m-0 text-dark">Évolution des ventes</h6>
                    <select class="form-select form-select-sm border-0 bg-light text-muted w-auto" style="font-size: 12px;">
                        <option>Cette semaine</option>
                        <option>Ce mois</option>
                    </select>
                </div>
                <div style="height: 260px; position: relative;">
                    <canvas id="salesEvolutionChart"></canvas>
                </div>
            </div>
        </div>

        
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                <h6 class="fw-bold mb-3 text-dark">Répartition des ventes</h6>
                <div class="d-flex justify-content-center align-items-center position-relative" style="height: 220px;">
                    <canvas id="categorySalesChart"></canvas>
                    <div class="position-absolute text-center" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        <span class="d-block fw-bold fs-5 text-dark">2.75M</span>
                        <small class="text-muted" style="font-size: 10px;">Total FCFA</small>
                    </div>
                </div>
                
                <div class="row g-2 mt-2 pt-2 border-top" style="font-size: 11px;">
                    <div class="col-6 d-flex align-items-center"><span class="badge rounded-circle me-2 p-1" style="background-color: #0d6efd;"> </span> Alimentaire</div>
                    <div class="col-6 d-flex align-items-center"><span class="badge rounded-circle me-2 p-1" style="background-color: #0dcaf0;"> </span> Boissons</div>
                    <div class="col-6 d-flex align-items-center"><span class="badge rounded-circle me-2 p-1" style="background-color: #198754;"> </span> Hygiène</div>
                    <div class="col-6 d-flex align-items-center"><span class="badge rounded-circle me-2 p-1" style="background-color: #fd7e14;"> </span> Entretien</div>
                    <div class="col-6 d-flex align-items-center"><span class="badge rounded-circle me-2 p-1" style="background-color: #6c757d;"> </span> Divers</div>
                </div>
            </div>
        </div>
    </div>

    
<div class="card border-0 shadow-sm rounded-4 bg-white p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold m-0 text-dark">Dernières ventes</h6>
        <a href="<?php echo e(route('admin.sales.index')); ?>" class="text-primary text-decoration-none fw-semibold" style="font-size: 13px;">Voir tout</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
            <thead class="table-light text-muted">
                <tr>
                    <th class="border-0 fw-semibold">N° Vente</th>
                    <th class="border-0 fw-semibold">Client</th>
                    <th class="border-0 fw-semibold">Date</th>
                    <th class="border-0 fw-semibold">Montant</th>
                    <th class="border-0 fw-semibold">Paiement</th>
                    <th class="border-0 fw-semibold text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    
                    <td class="fw-semibold text-dark">
                        <?php echo e($sale->code ?? 'VTS-' . str_pad($sale->id, 5, '0', STR_PAD_LEFT)); ?>

                    </td>

                    
                    <td>
                        <?php echo e(is_object($sale->client) ? $sale->client->name : ($sale->client_name ?? 'Client comptoir')); ?>

                    </td>

                    
                    <td class="text-muted">
                        <?php echo e($sale->created_at ? $sale->created_at->format('d/m/Y') : ''); ?>

                    </td>

                    <td class="fw-bold text-dark">
    <?php echo e(number_format($sale->total_amount ?? $sale->total ?? 0, 0, ',', ' ')); ?> FCFA
</td>

                    
                    <td>
                        <span class="badge bg-info-subtle text-info px-2 py-1 rounded-2">
                            <?php echo e($sale->payment_method ?? $sale->payment ?? 'Espèces'); ?>

                        </span>
                    </td>

                    
                    <td class="text-center">
                        <a href="<?php echo e(route('admin.sales.show', $sale->id)); ?>" class="btn btn-sm btn-light border rounded-circle p-1">
                            <i class="bi bi-eye text-secondary"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Aucune vente récente.</td>
                </tr>
               
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Graphique d'évolution des ventes (Courbe)
        const ctxEvolution = document.getElementById('salesEvolutionChart').getContext('2d');
        new Chart(ctxEvolution, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Ventes (FCFA)',
                    data: [1200000, 1900000, 1500000, 2200000, 1800000, 2400000, 2100000],
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.05)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#0d6efd',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { 
                        grid: { borderDash: [5, 5] },
                        ticks: {
                            callback: function(value) { return (value / 1000000) + 'M'; }
                        }
                    }
                }
            }
        });

        // 2. Graphique Donut (Répartition par catégorie)
        const ctxCategory = document.getElementById('categorySalesChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: ['Alimentaire', 'Boissons', 'Hygiène', 'Entretien', 'Divers'],
                datasets: [{
                    data: [45, 20, 15, 12, 8],
                    backgroundColor: ['#0d6efd', '#0dcaf0', '#198754', '#fd7e14', '#6c757d'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: { legend: { display: false } }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ndogaye Béye !!!\Documents\memoir\sen_distribution\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>