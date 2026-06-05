<?= view('layout/header') ?>

<div class="container-fluid px-0">
    
    <div class="row align-items-center mb-4 g-3 text-center text-sm-start">
        <div class="col-12 col-sm-auto me-auto">
            <h1 class="h3 fw-black text-dark tracking-tight m-0 d-flex align-items-center justify-content-center justify-content-sm-start gap-2">
                <i class="fas fa-boxes-stacked text-primary"></i> Manajemen Inventori
            </h1>
            <p class="text-muted small m-0 mt-1">Kelola etalase produk dagang dan ketersediaan bahan baku produksi.</p>
        </div>
        <div class="col-12 col-sm-auto d-flex justify-content-center gap-2">
            <?php if (session()->get('role') === 'superadmin'): ?>
                <a href="/produk/tambah" class="btn btn-success shadow-sm btn-md py-2 px-3 rounded-3 fw-bold Vite-btn-hover">
                    <i class="fas fa-plus me-1"></i> Tambah Produk
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <ul class="nav nav-tabs border-bottom-2 gap-1 justify-content-center justify-content-sm-start">
                <li class="nav-item">
                    <a class="nav-link active fw-bold px-4 py-2.5 rounded-top-3 border-bottom-0" href="/produk">
                        <i class="fas fa-cookie-bite me-2 text-primary"></i>Data Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary fw-semibold px-4 py-2.5 rounded-top-3 border-bottom-0 Vite-tab-hover" href="/bahanbaku">
                        <i class="fas fa-leaf me-2 text-success"></i>Bahan Baku
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 750px;">
                    <thead class="table-light border-bottom">
                        <tr>
                            <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 70px;">No</th>
                            <th class="py-3.5 text-secondary text-uppercase tracking-wider small fw-bold">Nama Produk</th>
                            <th class="py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 160px;">Harga Jual</th>
                            <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 120px;">Sisa Stok</th>
                            <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 320px;">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($produk as $p): ?>
                        <tr class="Vite-table-row">
                            <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                            <td>
                                <span class="fw-bold text-dark d-block"><?= $p['nama_produk'] ?></span>
                                <small class="text-muted fs-7">ID: PRD-<?= str_pad($p['id'], 4, '0', STR_PAD_LEFT) ?></small>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-2 fw-bold fs-6">
                                    Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="fw-black fs-5 <?= $p['stok'] <= 10 ? 'text-danger' : 'text-dark' ?>">
                                    <?= $p['stok'] ?>
                                </span>
                                <span class="text-muted small d-block fs-7">Pcs</span>
                            </td>
                            <td class="text-center">
                                <?php if (session()->get('role') === 'superadmin'): ?>
                                    <div class="d-inline-flex gap-1">
                                        <a href="/produk/edit/<?= $p['id'] ?>" class="btn btn-warning btn-sm px-3 py-1.5 rounded-2 fw-bold text-dark shadow-xs Vite-action-btn">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="/produk/resep/<?= $p['id'] ?>" class="btn btn-info btn-sm px-3 py-1.5 text-white rounded-2 fw-bold shadow-xs Vite-action-btn">
                                            <i class="fas fa-receipt me-1"></i> Resep
                                        </a>
                                        <a href="/produk/hapus/<?= $p['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk <?= $p['nama_produk'] ?>?')" class="btn btn-danger btn-sm px-3 py-1.5 rounded-2 fw-bold shadow-xs Vite-action-btn">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border px-3 py-2 rounded-pill small fw-medium">
                                        <i class="fas fa-lock me-1"></i> Akses Terbatas
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<style>
    .fw-black {
        font-weight: 800;
    }
    .tracking-tight {
        letter-spacing: -0.75px;
    }
    .tracking-wider {
        letter-spacing: 0.75px;
    }
    .fs-7 {
        font-size: 0.785rem;
    }
    
    /* Nav Tab Active Styling */
    .nav-tabs .nav-link.active {
        background-color: #ffffff !important;
        border-color: #dee2e6 #dee2e6 #ffffff !important;
        position: relative;
    }
    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background-color: #0d6efd;
        border-radius: 3px 3px 0 0;
    }

    /* Vite CSS Transition Simulation (Sangat Ringan & Efeknya Smooth) */
    .Vite-tab-hover {
        transition: all 0.2s ease-in-out;
    }
    .Vite-tab-hover:hover {
        background-color: #f8f9fa;
        color: #0d6efd !important;
    }
    .Vite-btn-hover {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    .Vite-btn-hover:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2) !important;
    }
    .Vite-table-row {
        transition: background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .Vite-table-row:hover {
        background-color: rgba(13, 110, 253, 0.02) !important;
    }
    .Vite-action-btn {
        transition: opacity 0.15s ease;
    }
    .Vite-action-btn:hover {
        opacity: 0.9;
    }
    .shadow-xs {
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
</style>

<?= view('layout/footer') ?>