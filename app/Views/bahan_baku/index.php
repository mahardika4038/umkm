<?= view('layout/header') ?>

<div class="container-fluid px-0">
    
    <div class="row align-items-center mb-4 g-3 text-center text-sm-start">
        <div class="col-12 col-sm-auto me-auto">
            <h1 class="h3 fw-black text-dark tracking-tight m-0 d-flex align-items-center justify-content-center justify-content-sm-start gap-2">
                <i class="fas fa-boxes-stacked text-primary"></i> Update Stok Massal
            </h1>
            <p class="text-muted small m-0 mt-1">Isi semua jumlah stok baru sekaligus untuk menghemat waktu operasional.</p>
        </div>
        
        <div class="col-12 col-sm-auto">
            <a href="/bahanbaku/tambah" class="btn btn-success px-4 py-2.5 rounded-3 fw-bold shadow-sm custom-btn-add">
                <i class="fas fa-plus me-1"></i> Tambah Bahan Baku Baru
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <ul class="nav nav-tabs border-bottom-2 gap-1 justify-content-center justify-content-sm-start">
                <li class="nav-item">
                    <a class="nav-link text-secondary fw-semibold px-4 py-2.5 rounded-top-3 border-bottom-0 Vite-tab-hover" href="/produk">
                        <i class="fas fa-cookie-bite me-2 text-secondary"></i>Data Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fw-bold px-4 py-2.5 rounded-top-3 border-bottom-0" href="/bahanbaku">
                        <i class="fas fa-leaf me-2 text-success"></i>Bahan Baku (Bulk Edit)
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <form action="/bahanbaku/simpanMassal" method="post">
        <?= csrf_field(); ?>
        
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                        <thead class="table-light border-bottom border-light-subtle">
                            <tr>
                                <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 70px;">No</th>
                                <th class="py-3.5 text-secondary text-uppercase tracking-wider small fw-bold">Nama Bahan Baku</th>
                                <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 160px;">Stok Saat Ini</th>
                                <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 220px;">+ Tambah Stok Baru</th>
                                <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 130px;">Satuan</th>
                                <th class="text-center py-3.5 text-secondary text-uppercase tracking-wider small fw-bold" style="width: 150px;">Status Minimal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bahanBaku)): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($bahanBaku as $index => $b): ?>
                                <?php $isKritis = $b['stok'] <= $b['minimal_stok']; ?>
                                <tr class="Vite-table-row">
                                    <td class="text-center fw-bold text-muted"><?= $no++ ?></td>
                                    <td>
                                        <span class="fw-bold text-dark d-block mb-0.5"><?= $b['nama_bahan'] ?></span>
                                        <span class="text-muted small bg-light px-2 py-0.5 rounded border border-light-subtle fs-7">
                                            Min. Stok: <b><?= $b['minimal_stok'] ?></b> <?= $b['satuan'] ?>
                                        </span>
                                        <input type="hidden" name="bahan[<?= $index ?>][id]" value="<?= $b['id'] ?>">
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 <?= $isKritis ? 'text-danger bg-danger-subtle px-3 py-1 rounded-3 d-inline-block' : 'text-primary bg-primary-subtle px-3 py-1 rounded-3 d-inline-block' ?>">
                                            <?= $b['stok'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm mx-auto shadow-sm input-box-wrapper" style="max-width: 150px;">
                                            <span class="input-group-text bg-white text-success fw-bold border-success-subtle">+</span>
                                            <input type="number" 
                                                   name="bahan[<?= $index ?>][stok_tambahan]" 
                                                   class="form-control text-center fw-bold text-success border-success-subtle input-stok-massal" 
                                                   min="0" 
                                                   value="0"
                                                   onclick="this.select();">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-2 fw-semibold">
                                            <?= $b['satuan'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($isKritis): ?>
                                            <span class="badge bg-danger text-white border-0 px-3 py-2 rounded-pill fw-bold animate-pulse-subtle shadow-sm">
                                                <i class="fas fa-triangle-exclamation me-1"></i> Restock
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-bold">
                                                <i class="fas fa-circle-check me-1"></i> Aman
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fs-2 mb-3 text-secondary d-block"></i>
                                        <span class="fw-bold d-block text-dark">Belum Ada Data Bahan Baku</span>
                                        Silakan tambah bahan baku baru terlebih dahulu menggunakan tombol di atas.
                                    </td>
                                endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-light border-top p-3 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                <span class="text-muted small text-center text-sm-start">
                    <i class="fas fa-info-circle text-primary me-1"></i> 
                    Tips cepat: Tekan tombol <b>Tab</b> pada keyboard untuk pindah mengisi baris bawahnya secara instan.
                </span>
                <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 fw-bold shadow-sm w-100 w-sm-auto Vite-btn-hover">
                    <i class="fas fa-cloud-arrow-up me-1"></i> Simpan Semua Stok Terbaru
                </button>
            </div>
        </div>
    </form>

</div>

<style>
    .fw-black { font-weight: 800; }
    .tracking-tight { letter-spacing: -0.75px; }
    .tracking-wider { letter-spacing: 0.75px; }
    .fs-7 { font-size: 0.75rem; }
    .mb-0.5 { margin-bottom: 0.15rem; }
    
    /* Nav Tab Active styling */
    .nav-tabs .nav-link.active {
        background-color: #ffffff !important;
        border-color: #dee2e6 #dee2e6 #ffffff !important;
        position: relative;
    }
    .nav-tabs .nav-link.active::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background-color: #198754; border-radius: 3px 3px 0 0;
    }

    .Vite-tab-hover { transition: all 0.2s ease-in-out; }
    .Vite-tab-hover:hover { background-color: #f8f9fa; color: #198754 !important; }
    
    .Vite-btn-hover, .custom-btn-add { transition: transform 0.15s ease, box-shadow 0.15s ease; }
    .Vite-btn-hover:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25) !important; }
    .custom-btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, 0.25) !important; }
    
    /* Animasi Hover & Fokus Baris Tabel (UX Booster) */
    .Vite-table-row { transition: all 0.15s ease-in-out; border-left: 4px solid transparent; }
    .Vite-table-row:hover { background-color: rgba(248, 249, 250, 0.8) !important; }
    
    /* Saat kotak input di baris tersebut aktif, satu baris akan menyala */
    .Vite-table-row:focus-within {
        background-color: #f4faf6 !important; 
        border-left: 4px solid #198754;
    }
    
    /* Fokus Efek Input Box */
    .input-box-wrapper { transition: all 0.2s; }
    .input-stok-massal:focus {
        background-color: #ffffff !important;
        border-color: #198754 !important;
        box-shadow: none !important;
    }
    .input-box-wrapper:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.2) !important;
        transform: scale(1.02);
    }

    @keyframes pulseSubtle {
        0%, 100% { transform: scale(1); opacity: 1; } 
        50% { transform: scale(0.96); opacity: 0.9; }
    }
    .animate-pulse-subtle { animation: pulseSubtle 2.5s infinite ease-in-out; }
</style>

<?= view('layout/footer') ?>