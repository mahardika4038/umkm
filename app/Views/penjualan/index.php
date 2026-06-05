<?= view('layout/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 fw-bold text-dark m-0 d-flex align-items-center gap-2">
            <i class="fas fa-cash-register text-primary"></i> <?= $title ?>
        </h1>
        <p class="text-muted small m-0 mt-1 d-none d-sm-block">Pilih menu, tentukan varian/level beserta penyesuaian harga, lalu proses pembayaran.</p>
    </div>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show small mb-4 rounded-3" role="alert">
        <i class="fas fa-exclamation-circle me-1"></i> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('sukses')) : ?>
    <div class="alert alert-success alert-dismissible fade show small mb-4 rounded-3" role="alert">
        <i class="fas fa-check-circle me-1"></i> <?= session()->getFlashdata('sukses') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    
    <!-- SEKSYEN 1: FORM INPUT PRODUK & VARIAN -->
    <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-header bg-light py-3 border-bottom border-light">
                <h5 class="card-title m-0 fw-bold text-secondary small">
                    <i class="fas fa-utensils text-primary me-1"></i> 1. Pilih Menu & Atur Varian
                </h5>
            </div>
            <div class="card-body p-3 p-sm-4">
                
                <!-- PILIH PRODUK Utama -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary small">Nama Produk</label>
                    <select id="select-produk" class="form-select bg-light py-2.5 rounded-3 fw-bold">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produk as $p) : ?>
                            <option value="<?= $p['id'] ?>" data-nama="<?= $p['nama_produk'] ?>" data-stok="<?= $p['stok'] ?>" data-harga="<?= $p['harga'] ?>">
                                <?= $p['nama_produk'] ?> (Stok: <?= $p['stok'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- DINAMIS: VARIAN LEVEL SEBLAK (Hanya muncul jika produk seblak) -->
                <div class="mb-3 d-none animate-fade" id="container-level">
                    <label class="form-label fw-semibold text-danger small"><i class="fas fa-pepper-hot me-1"></i> Tingkat Kepedasan (+ Selisih Harga)</label>
                    <select id="select-level" class="form-select bg-light py-2.5 rounded-3 border-danger-subtle fw-medium">
                        <option value="Level 0 (Original)" data-extra="0">Level 0 (Original) - [Rp 0]</option>
                        <option value="Level 1 (Senggol)" data-extra="0">Level 1 (Senggol Nyengir) - [Rp 0]</option>
                        <option value="Level 2 (Sedang)" data-extra="0">Level 2 (Santai Aja) - [Rp 0]</option>
                        <option value="Level 3 (Pedas)" data-extra="1000">Level 3 (Lumayan) - [+Rp 1.000]</option>
                        <option value="Level 4 (Gila)" data-extra="2000">Level 4 (Gila Cabe) - [+Rp 2.000]</option>
                        <option value="Level 5 (Dower)" data-extra="3000">Level 5 (Nangis Kejer) - [+Rp 3.000]</option>
                    </select>
                </div>

                <!-- DINAMIS: VARIAN RASA PISANG COKLAT (Hanya muncul jika produk pisang) -->
                <div class="mb-3 d-none animate-fade" id="container-rasa">
                    <label class="form-label fw-semibold text-warning small"><i class="fas fa-ice-cream me-1"></i> Varian Rasa / Topping (+ Selisih Harga)</label>
                    <select id="select-rasa" class="form-select bg-light py-2.5 rounded-3 border-warning-subtle fw-medium">
                        <option value="Coklat Original" data-extra="0">Coklat Original - [Rp 0]</option>
                        <option value="Coklat Keju" data-extra="2000">Coklat Keju - [+Rp 2.000]</option>
                        <option value="Double Choco" data-extra="1500">Double Chocolate - [+Rp 1.500]</option>
                        <option value="Matcha Glaze" data-extra="2500">Matcha Glaze - [+Rp 2.500]</option>
                        <option value="Tiramisu Almond" data-extra="3500">Tiramisu Almond - [+Rp 3.500]</option>
                    </select>
                </div>

                <!-- DINAMIS: KETERANGAN UMUM (Untuk produk selain seblak & pisang) -->
                <div class="mb-3 d-none animate-fade" id="container-keterangan">
                    <label class="form-label fw-semibold text-secondary small"><i class="fas fa-comment-dots me-1"></i> Catatan Kustom (Opsional)</label>
                    <input type="text" id="input-keterangan-manual" class="form-control bg-light py-2.5 rounded-3" placeholder="Contoh: tidak pakai sayur, es dipisah">
                </div>

                <!-- HARGA JUAL (BISA DIEDIT MANUALLY OLEH KASIR) -->
                <div class="mb-3">
                    <label class="form-label fw-semibold text-primary small"><i class="fas fa-tags me-1"></i> Harga Satuan (Bisa Diedit Kasir)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white border-0 fw-bold">Rp</span>
                        <input type="number" id="input-harga-final" class="form-control bg-white py-2.5 rounded-end-3 fw-bold fs-5 text-primary border-primary-subtle" value="0">
                    </div>
                    <div class="form-text text-muted fs-7">Harga otomatis menyesuaikan varian, namun tetap bebas kamu ubah manual jika ada harga khusus.</div>
                </div>

                <!-- JUMLAH PORSI -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary small d-block">Jumlah Porsi</label>
                    <div class="input-group" style="max-width: 160px;">
                        <button class="btn btn-outline-secondary shadow-sm" type="button" id="btn-minus"><i class="fas fa-minus"></i></button>
                        <input type="number" id="input-jumlah" min="1" value="1" class="form-control text-center fw-bold bg-light" readonly>
                        <button class="btn btn-outline-secondary shadow-sm" type="button" id="btn-plus"><i class="fas fa-plus"></i></button>
                    </div>
                </div>

                <button type="button" id="btn-tambah-keranjang" class="btn btn-primary w-100 py-2.5 fw-bold rounded-3 shadow-sm">
                    <i class="fas fa-cart-plus me-1"></i> Tambah ke Keranjang
                </button>
            </div>
        </div>
    </div>

    <!-- SEKSYEN 2: DAFTAR PESANAN (KERANJANG) -->
    <div class="col-12 col-lg-7">
        <form action="/penjualan/simpan" method="post">
            <?= csrf_field(); ?>
            
            <div class="card border-0 shadow-sm rounded-3 bg-white">
                <div class="card-header bg-light py-3 border-bottom border-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0 fw-bold text-secondary small">
                        <i class="fas fa-shopping-basket text-success me-1"></i> 2. Daftar Pesanan
                    </h5>
                    <span class="badge bg-primary rounded-pill" id="total-item-badge">0 Item</span>
                </div>
                
                <!-- Tampilan Desktop -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table align-middle mb-0" id="tabel-keranjang">
                        <thead class="table-light small border-bottom">
                            <tr>
                                <th class="py-3 px-3">Menu & Varian</th>
                                <th class="py-3 text-center" style="width: 70px;">Qty</th>
                                <th class="py-3 text-end" style="width: 120px;">Harga Satuan</th>
                                <th class="py-3 text-end" style="width: 130px;">Subtotal</th>
                                <th class="py-3 text-center" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="list-keranjang-desktop"></tbody>
                    </table>
                </div>

                <!-- Tampilan Mobile -->
                <div class="d-block d-md-none p-2" id="list-keranjang-mobile"></div>

                <!-- Indikator Keranjang Kosong -->
                <div id="keranjang-kosong" class="text-center py-5 text-muted">
                    <i class="fas fa-shopping-bag fa-2x mb-2 d-block opacity-25"></i>
                    <span class="small">Belum ada menu pilihan di keranjang.</span>
                </div>

                <!-- AKUMULASI & TOMBOL SUBMIT -->
                <div class="card-body bg-light border-top p-3 rounded-bottom-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-secondary small">TOTAL BAYAR:</span>
                        <h2 class="m-0 fw-bold text-success fs-3" id="text-total-bayar">Rp 0</h2>
                    </div>

                    <div class="row g-2">
                        <div class="col-12 col-sm-8">
                            <button type="submit" id="btn-checkout" class="btn btn-success w-100 py-2.5 rounded-3 fw-bold text-white shadow-sm" disabled>
                                <i class="fas fa-paper-plane me-1"></i> SIMPAN & BAYAR RESMI
                            </button>
                        </div>
                        <div class="col-12 col-sm-4">
                            <button type="button" id="btn-kosongkan" class="btn btn-outline-danger w-100 py-2.5 rounded-3 fw-semibold small">
                                Kosongkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const selectProduk = document.getElementById("select-produk");
    const containerLevel = document.getElementById("container-level");
    const selectLevel = document.getElementById("select-level");
    const containerRasa = document.getElementById("container-rasa");
    const selectRasa = document.getElementById("select-rasa");
    const containerKeterangan = document.getElementById("container-keterangan");
    const inputKeteranganManual = document.getElementById("input-keterangan-manual");
    const inputHargaFinal = document.getElementById("input-harga-final");
    
    const inputJumlah = document.getElementById("input-jumlah");
    const btnPlus = document.getElementById("btn-plus");
    const btnMinus = document.getElementById("btn-minus");
    const btnTambah = document.getElementById("btn-tambah-keranjang");
    const listDesktop = document.getElementById("list-keranjang-desktop");
    const listMobile = document.getElementById("list-keranjang-mobile");
    const keranjangKosong = document.getElementById("keranjang-kosong");
    const textTotalBayar = document.getElementById("text-total-bayar");
    const badgeItem = document.getElementById("total-item-badge");
    const btnCheckout = document.getElementById("btn-checkout");
    const btnKosongkan = document.getElementById("btn-kosongkan");

    let keranjang = [];
    let baseHargaProduk = 0;

    // Fungsi Pembantu Sembunyikan Semua Form Varian
    function sembunyikanSemuaVarian() {
        containerLevel.classList.add("d-none");
        containerRasa.classList.add("d-none");
        containerKeterangan.classList.add("d-none");
        selectLevel.selectedIndex = 0;
        selectRasa.selectedIndex = 0;
        inputKeteranganManual.value = "";
    }

    // Hitung Ulang Harga Berdasarkan Produk + Selisih Varian Dropdown
    function hitungOtomatisHarga() {
        let extraCost = 0;
        const namaProduk = selectProduk.options[selectProduk.selectedIndex].getAttribute("data-nama") || "";
        
        if (namaProduk.toLowerCase().includes("seblak")) {
            extraCost = parseInt(selectLevel.options[selectLevel.selectedIndex].getAttribute("data-extra")) || 0;
        } else if (namaProduk.toLowerCase().includes("pisang")) {
            extraCost = parseInt(selectRasa.options[selectRasa.selectedIndex].getAttribute("data-extra")) || 0;
        }
        
        inputHargaFinal.value = baseHargaProduk + extraCost;
    }

    // Event saat Produk Utama Dipilih
    selectProduk.addEventListener("change", function() {
        const selectedOption = this.options[this.selectedIndex];
        sembunyikanSemuaVarian();

        if (!selectedOption.value) {
            baseHargaProduk = 0;
            inputHargaFinal.value = 0;
            return;
        }
        
        baseHargaProduk = parseInt(selectedOption.getAttribute("data-harga")) || 0;
        const namaProduk = selectedOption.getAttribute("data-nama").toLowerCase();
        
        if (namaProduk.includes("seblak")) {
            containerLevel.classList.remove("d-none");
        } else if (namaProduk.includes("pisang")) {
            containerRasa.classList.remove("d-none");
        } else {
            containerKeterangan.classList.remove("d-none");
        }
        
        hitungOtomatisHarga();
    });

    // Event saat Varian Dropdown Diubah (Mengubah nilai input harga otomatis)
    selectLevel.addEventListener("change", hitungOtomatisHarga);
    selectRasa.addEventListener("change", hitungOtomatisHarga);

    // Kontrol Tombol Plus / Minus Qty
    btnPlus.addEventListener("click", () => {
        let val = parseInt(inputJumlah.value);
        inputJumlah.value = isNaN(val) ? 1 : val + 1;
    });
    btnMinus.addEventListener("click", () => {
        let val = parseInt(inputJumlah.value);
        if (val > 1) inputJumlah.value = val - 1;
    });

    function formatRupiah(angka) {
        return "Rp " + new Intl.NumberFormat("id-ID").format(angka);
    }

    // RENDER KERANJANG BELANJA
    function renderKeranjang() {
        listDesktop.innerHTML = '';
        listMobile.innerHTML = '';

        if (keranjang.length === 0) {
            keranjangKosong.style.display = 'block';
            textTotalBayar.innerText = "Rp 0";
            badgeItem.innerText = "0 Item";
            btnCheckout.disabled = true;
            return;
        }

        keranjangKosong.style.display = 'none';
        let totalBayar = 0;
        let totalQty = 0;

        keranjang.forEach((item, index) => {
            const subtotal = item.harga * item.jumlah;
            totalBayar += subtotal;
            totalQty += parseInt(item.jumlah);

            // Pembentukan label badge varian di keranjang
            let badgeVarian = "";
            if (item.varian) {
                let badgeClass = "bg-secondary";
                if (item.varian.includes("Level")) badgeClass = "bg-danger";
                if (item.varian.includes("Coklat") || item.varian.includes("Almond")) badgeClass = "bg-warning text-dark";
                badgeVarian = `<span class="badge ${badgeClass} small ms-1">${item.varian}</span>`;
            }

            // Render baris Desktop (Terbaca input HARGA kustom untuk dikirim ke controller backend)
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td class="px-3">
                    <div class="fw-bold text-dark">${item.nama} ${badgeVarian}</div>
                    <input type="hidden" name="produk_id[]" value="${item.id}">
                    <input type="hidden" name="jumlah[]" value="${item.jumlah}">
                    <input type="hidden" name="level[]" value="${item.varian}">
                    <input type="hidden" name="harga[]" value="${item.harga}">
                </td>
                <td class="text-center text-muted fw-bold">${item.jumlah}</td>
                <td class="text-end text-secondary fw-medium">${formatRupiah(item.harga)}</td>
                <td class="text-end fw-bold text-success">${formatRupiah(subtotal)}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm text-danger btn-hapus-item" data-index="${index}"><i class="fas fa-trash-alt"></i></button>
                </td>
            `;
            listDesktop.appendChild(tr);

            // Render Tampilan Handphone
            const mobileCard = document.createElement("div");
            mobileCard.className = "p-3 mb-2 border rounded-3 bg-light d-flex align-items-center justify-content-between shadow-sm";
            mobileCard.innerHTML = `
                <div>
                    <div class="fw-bold text-dark small">${item.nama} ${badgeVarian}</div>
                    <div class="text-muted fs-7">${item.jumlah} x ${formatRupiah(item.harga)}</div>
                    <div class="fw-bold text-success small">Subtotal: ${formatRupiah(subtotal)}</div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-item" data-index="${index}"><i class="fas fa-trash-alt"></i></button>
            `;
            listMobile.appendChild(mobileCard);
        });

        textTotalBayar.innerText = formatRupiah(totalBayar);
        badgeItem.innerText = totalQty + " Item";
        btnCheckout.disabled = false;
    }

    // PROSES TAMBAH KE KERANJANG
    btnTambah.addEventListener("click", function() {
        const selectedOption = selectProduk.options[selectProduk.selectedIndex];
        if (!selectedOption.value) {
            alert("Silakan pilih produk menu terlebih dahulu!");
            return;
        }

        const id = selectedOption.value;
        const nama = selectedOption.getAttribute("data-nama");
        const stok = parseInt(selectedOption.getAttribute("data-stok"));
        const jumlah = parseInt(inputJumlah.value);
        
        // Ambil harga dari kotak input (bisa berupa harga edit manual kasir)
        const hargaFinalKasir = parseInt(inputHargaFinal.value);
        if (isNaN(hargaFinalKasir) || hargaFinalKasir < 0) {
            alert("Isian harga tidak valid!");
            return;
        }

        // Tentukan nilai varian string
        let varianSelected = "";
        if (!containerLevel.classList.contains("d-none")) {
            varianSelected = selectLevel.value;
        } else if (!containerRasa.classList.contains("d-none")) {
            varianSelected = selectRasa.value;
        } else if (!containerKeterangan.classList.contains("d-none")) {
            varianSelected = inputKeteranganManual.value;
        }

        // Cari item di keranjang dengan ID, VARIAN, dan HARGA yang persis sama
        // Jika ada perbedaan harga/varian, item sengaja dipisahkan barisnya agar rapi di nota pembeli
        const indexEksis = keranjang.findIndex(item => item.id === id && item.varian === varianSelected && item.harga === hargaFinalKasir);
        let totalJumlahBaru = jumlah;
        
        if (indexEksis !== -1) totalJumlahBaru += keranjang[indexEksis].jumlah;
        if (totalJumlahBaru > stok) {
            alert(`Stok tidak mencukupi! Sisa stok untuk ${nama} adalah ${stok} porsi.`);
            return;
        }

        if (indexEksis !== -1) {
            keranjang[indexEksis].jumlah = totalJumlahBaru;
        } else {
            keranjang.push({ id, nama, harga: hargaFinalKasir, jumlah, varian: varianSelected });
        }

        // Setel kembali form input ke kondisi semula
        selectProduk.value = "";
        sembunyikanSemuaVarian();
        inputHargaFinal.value = "0";
        inputJumlah.value = "1";
        renderKeranjang();
    });

    // Menghapus Item Tunggal di Keranjang
    window.addEventListener("click", function(e) {
        const targetBtn = e.target.closest(".btn-hapus-item");
        if (targetBtn) {
            const index = targetBtn.getAttribute("data-index");
            keranjang.splice(index, 1);
            renderKeranjang();
        }
    });

    // Reset Semua Isi Keranjang
    btnKosongkan.addEventListener("click", function() {
        if(confirm("Apakah Anda yakin ingin mengosongkan daftar pesanan?")) {
            keranjang = [];
            renderKeranjang();
        }
    });
});
</script>

<style>
.animate-fade {
    animation: fadeIn 0.3s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}
.fs-7 { font-size: 0.75rem; }
</style>

<?= view('layout/footer') ?>