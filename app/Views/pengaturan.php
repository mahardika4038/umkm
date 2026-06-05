<?= view('layout/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 fw-bold text-dark m-0 d-flex align-items-center gap-2">
            <i class="fas fa-sliders-h text-primary"></i> <?= $title ?>
        </h1>
        <p class="text-muted small m-0 mt-1">Konfigurasi identitas toko, cetakan struk nota belanja, dan rules default sistem kasir.</p>
    </div>
</div>

<?php if (session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success alert-dismissible fade show small mb-4 rounded-3 shadow-sm" role="alert">
        <i class="fas fa-check-circle me-1"></i> <?= session()->getFlashdata('sukses') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-12 col-xl-8">
        
        <form action="/pengaturan/simpan" method="post">
            <?= csrf_field(); ?>

            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-header bg-light p-0 border-bottom">
                    <ul class="nav nav-tabs card-header-tabs m-0 border-0" id="settingTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active py-3 px-4 fw-bold small text-secondary" id="toko-tab" data-bs-toggle="tab" data-bs-target="#tab-toko" type="button" role="tab">
                                <i class="fas fa-store me-1.5 text-primary"></i> 1. Profil Toko
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link py-3 px-4 fw-bold small text-secondary" id="struk-tab" data-bs-toggle="tab" data-bs-target="#tab-struk" type="button" role="tab">
                                <i class="fas fa-receipt me-1.5 text-success"></i> 2. Kasir & Nota Struk
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <div class="tab-content" id="settingTabsContent">
                        
                        <div class="tab-pane fade show active" id="tab-toko" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Nama Bisnis / Toko</label>
                                <input type="text" name="nama_toko" class="form-control bg-light py-2" value="<?= $toko['nama_toko'] ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-secondary small">Nomor Telepon / WhatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-phone-alt fs-7"></i></span>
                                    <input type="text" name="telepon" class="form-control bg-light border-start-0 ps-1 py-2" value="<?= $toko['telepon'] ?>" required>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label fw-semibold text-secondary small">Alamat Fisik Outlet</label>
                                <textarea name="alamat" class="form-control bg-light py-2" rows="3" required><?= $toko['alamat'] ?></textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-struk" role="tabpanel">
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-sm-6">
                                    <label class="form-label fw-semibold text-secondary small">Tarif Pajak Penjualan (PPN)</label>
                                    <div class="input-group">
                                        <input type="number" name="pajak" class="form-control bg-light py-2 text-center fw-bold" value="<?= $toko['pajak'] ?>" min="0" max="100">
                                        <span class="input-group-text bg-light fw-bold">%</span>
                                    </div>
                                    <div class="form-text fs-7 text-muted">Isi angka 0 jika menu jualan tidak dikenakan PPN otomatis.</div>
                                </div>
                                
                                <div class="col-12 col-sm-6">
                                    <label class="form-label fw-semibold text-secondary small">Default Limit Stok Menipis</label>
                                    <div class="input-group">
                                        <input type="number" name="alert_stok" class="form-control bg-light py-2 text-center fw-bold" value="<?= $toko['alert_stok'] ?>" min="1">
                                        <span class="input-group-text bg-light text-muted small">Porsi/Kg</span>
                                    </div>
                                    <div class="form-text fs-7 text-muted">Acuan angka peringatan restock global di halaman bahan baku.</div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label fw-semibold text-secondary small">Catatan Kaki Struk (Footer Note)</label>
                                <textarea name="note_struk" class="form-control bg-light py-2" rows="3" placeholder="Contoh: Barang yang sudah dibeli tidak dapat ditukar balik..."><?= $toko['note_struk'] ?></textarea>
                                <div class="form-text fs-7 text-muted">Kalimat ramah tamah yang tercantum paling bawah pada lembar cetak thermal struk belanja konsumen.</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer bg-light border-top p-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 fw-bold shadow-sm custom-btn-save">
                        <i class="fas fa-save me-1.5"></i> Simpan Seluruh Perubahan
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<style>
    /* Styling khusus merapikan Nav Tabs Bootstrap agar terlihat profesional */
    .nav-tabs .nav-link {
        border: none !important;
        border-bottom: 3px solid transparent !important;
        background: transparent !important;
        transition: all 0.2s ease;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd !important;
        border-bottom-color: #0d6efd !important;
    }
    .nav-tabs .nav-link:hover:not(.active) {
        border-bottom-color: #dee2e6 !important;
        color: #343a40 !important;
    }
    .me-1.5 { margin-right: 0.375rem; }
    .fs-7 { font-size: 0.75rem; }
    
    .custom-btn-save { transition: transform 0.15s ease; }
    .custom-btn-save:hover { transform: translateY(-1px); }
</style>

<?= view('layout/footer') ?>