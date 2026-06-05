<?= view('layout/header') ?>

<div class="container-fluid px-0">
    
    <div class="row align-items-center mb-4 g-3 text-center text-sm-start">
        <div class="col-12 col-sm-auto me-auto">
            <h1 class="h3 fw-black text-dark tracking-tight m-0 d-flex align-items-center justify-content-center justify-content-sm-start gap-2">
                <i class="fas fa-plus-circle text-success"></i> <?= $title ?? 'Tambah Bahan Baku Baru' ?>
            </h1>
            <p class="text-muted small m-0 mt-1">Daftarkan bahan baku baru ke dalam sistem master data inventaris.</p>
        </div>
        
        <div class="col-12 col-sm-auto">
            <a href="/bahanbaku" class="btn btn-light border border-secondary-subtle px-3 py-2 rounded-3 text-secondary small fw-bold custom-btn-back">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Stok Massal
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6"> <form action="/bahanbaku/simpan" method="post">
                <?= csrf_field(); ?>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
                    <div class="card-body p-4">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary text-uppercase tracking-wider small mb-2">Nama Bahan Baku</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-tag"></i></span>
                                <input type="text" name="nama_bahan" class="form-control border-start-0 ps-1" placeholder="Contoh: Cabai Rawit, Tepung Terigu" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12 col-sm-6 mb-4 mb-sm-0">
                                <label class="form-label fw-bold text-secondary text-uppercase tracking-wider small mb-2">Stok Awal</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-cubes"></i></span>
                                    <input type="number" name="stok" class="form-control border-start-0 ps-1 text-center fw-bold text-primary" value="0" min="0" required>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6">
                                <label class="form-label fw-bold text-secondary text-uppercase tracking-wider small mb-2">Batas Peringatan (Min. Stok)</label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-triangle-exclamation"></i></span>
                                    <input type="number" name="minimal_stok" class="form-control border-start-0 ps-1 text-center fw-bold text-danger" value="5" min="0" required>
                                </div>
                                <div class="form-text text-muted fs-7 mt-1.5">Sistem memicu status <span class="text-danger fw-bold">Restock</span> jika stok sama atau di bawah angka ini.</div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-bold text-secondary text-uppercase tracking-wider small mb-2">Satuan</label>
                            <div class="input-group input-group-custom">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-weight-scale"></i></span>
                                <input type="text" name="satuan" class="form-control border-start-0 ps-1" placeholder="Contoh: Kg, Gram, Pcs, Liter" required>
                            </div>
                        </div>

                    </div>
                    
                    <div class="card-footer bg-light border-top p-3 d-flex justify-content-end gap-2">
                        <a href="/bahanbaku" class="btn btn-light border px-4 py-2.5 rounded-3 fw-bold text-secondary custom-btn-cancel">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-success px-4 py-2.5 rounded-3 fw-bold shadow-sm custom-btn-save">
                            <i class="fas fa-floppy-disk me-1"></i> Simpan Bahan Baru
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

<style>
    .fw-black { font-weight: 800; }
    .tracking-tight { letter-spacing: -0.75px; }
    .tracking-wider { letter-spacing: 0.75px; }
    .fs-7 { font-size: 0.725rem; }
    .mt-1.5 { margin-top: 0.35rem; }
    
    /* Animasi Hover Tombol */
    .custom-btn-save, .custom-btn-back, .custom-btn-cancel { transition: transform 0.15s ease, box-shadow 0.15s ease; }
    .custom-btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(25, 135, 84, 0.25) !important; }
    .custom-btn-back:hover, .custom-btn-cancel:hover { background-color: #f1f3f5 !important; transform: translateY(-1px); }

    /* Efek Fokus Form yang Interaktif dan Indah */
    .input-group-custom { transition: all 0.2s ease-in-out; border-radius: 0.375rem; overflow: hidden; }
    .input-group-custom .form-control:focus {
        box-shadow: none !important;
        background-color: #ffffff !important;
    }
    .input-group-custom:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15) !important;
    }
    .input-group-custom:focus-within .input-group-text,
    .input-group-custom:focus-within .form-control {
        border-color: #198754 !important;
    }
</style>

<?= view('layout/footer') ?>