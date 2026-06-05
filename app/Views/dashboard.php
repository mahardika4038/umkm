<?= view('layout/header') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid px-0">
    
    <div class="row mb-4 g-3 align-items-center text-center text-md-start">
        <div class="col-12 col-md-auto me-auto">
            <h1 class="h3 fw-black text-dark tracking-tight m-0 d-flex align-items-center gap-2 justify-content-center justify-content-md-start">
                <i class="fas fa-chart-pie text-primary"></i> <?= $title ?>
            </h1>
            <p class="text-muted small m-0 mt-1">Laporan performa toko yang mudah dibaca oleh siapa saja (bahkan untuk pemula).</p>
        </div>
        <div class="col-12 col-md-auto d-flex justify-content-center gap-2">
            <button onclick="eksporKeExcel()" class="btn btn-success px-3 py-2 rounded-3 shadow-sm small fw-bold">
                <i class="fas fa-file-excel me-2"></i> Download Laporan Excel
            </button>
            <span class="badge bg-white text-secondary border shadow-sm px-3 py-2 rounded-3 small fw-medium d-flex align-items-center">
                <i class="fas fa-calendar-alt text-primary me-2"></i> Hari Ini: <?= date('d M Y') ?>
            </span>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white transition-all hover-translate-y">
                <div class="card-body p-4 text-center text-sm-start">
                    <div class="text-uppercase text-muted small fw-bold tracking-wider mb-2">💰 Total Uang Masuk</div>
                    <h2 class="fw-black text-success mb-1"><?= $totalPenjualan ?></h2>
                    <span class="text-success small fw-semibold"><i class="fas fa-arrow-trend-up me-1"></i> Omset Real-time</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white transition-all hover-translate-y">
                <div class="card-body p-4 text-center text-sm-start">
                    <div class="text-uppercase text-muted small fw-bold tracking-wider mb-2">📦 Total Menu Aktif</div>
                    <h2 class="fw-black text-dark mb-1"><?= $totalProduk ?> <span class="fs-5 text-muted fw-normal">Varian</span></h2>
                    <span class="text-muted small">Pilihan makanan di kasir</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 transition-all hover-translate-y <?= $stokHampirHabis > 0 ? 'bg-danger-subtle border border-danger-subtle' : 'bg-white' ?>">
                <div class="card-body p-4 text-center text-sm-start">
                    <div class="text-uppercase small fw-bold tracking-wider mb-2 <?= $stokHampirHabis > 0 ? 'text-danger-emphasis' : 'text-muted' ?>">⚠️ Bahan Menipis</div>
                    <h2 class="fw-black mb-1 <?= $stokHampirHabis > 0 ? 'text-danger' : 'text-dark' ?>"><?= $stokHampirHabis ?> <span class="fs-5 fw-normal">Item</span></h2>
                    <span class="small <?= $stokHampirHabis > 0 ? 'text-danger-emphasis fw-bold' : 'text-muted' ?>">
                        <?= $stokHampirHabis > 0 ? '🚨 Harus Segera Belanja!' : 'Gudang Aman' ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 text-white transition-all hover-translate-y" style="background: linear-gradient(135deg, #1d2b64, #f8cdda);">
                <div class="card-body p-4 text-center text-sm-start bg-primary rounded-4">
                    <div class="text-uppercase text-white opacity-75 small fw-bold tracking-wider mb-2">🔥 Paling Laku (Juara)</div>
                    <h4 class="fw-black text-white mb-1 text-truncate mx-auto mx-sm-0" style="max-width: 90%;"><?= $produkTerlaris ?></h4>
                    <span class="small text-white opacity-75">Favorit pelanggan saat ini</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <h5 class="fw-bold text-dark mb-1"><i class="fas fa-chart-line text-primary me-2"></i> Grafik Naik Turun Pendapatan</h5>
                <p class="text-muted small mb-4">Garis yang semakin naik menunjukkan tokomu makin untung.</p>
                <div style="height: 300px; position: relative;">
                    <canvas id="grafikOmset"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                <h5 class="fw-bold text-dark mb-1"><i class="fas fa-chart-pie text-warning me-2"></i> Porsi Menu Terjual</h5>
                <p class="text-muted small mb-4">Melihat menu apa saja yang mendominasi pasar.</p>
                <div style="height: 300px; position: relative;" class="d-flex justify-content-center">
                    <canvas id="grafikMenuTerlaris"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                <div class="card-header bg-light py-3 px-4 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold text-secondary small-title"><i class="fas fa-list-ol me-2 text-primary"></i> Tabel Rincian Dagangan Laku</h5>
                    <span class="text-muted fs-7">Data otomatis masuk setelah kasir klik bayar</span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tabelLaporanPenjualan">
                        <thead class="table-light text-secondary small fw-bold">
                            <tr>
                                <th class="py-3 px-4">Nama Produk / Menu Makanan</th>
                                <th class="py-3 text-center">Jumlah Terjual</th>
                                <th class="py-3 text-end">Harga Satuan</th>
                                <th class="py-3 text-end px-4">Total Hasil Uang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($listLaporan) && !empty($listLaporan)): ?>
                                <?php foreach($listLaporan as $row): ?>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-dark"><?= $row['nama_produk'] ?></td>
                                    <td class="py-3 text-center fw-bold text-primary"><?= $row['terjual'] ?> Porsi</td>
                                    <td class="py-3 text-end text-muted">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td class="py-3 text-end fw-black text-success px-4">Rp <?= number_format($row['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-dark">Seblak Spesial Level 3</td>
                                    <td class="py-3 text-center fw-bold text-primary">45 Porsi</td>
                                    <td class="py-3 text-end text-muted">Rp 16.000</td>
                                    <td class="py-3 text-end fw-black text-success px-4">Rp 720.000</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-dark">Pisang Coklat Keju Crunchy</td>
                                    <td class="py-3 text-center fw-bold text-primary">32 Porsi</td>
                                    <td class="py-3 text-end text-muted">Rp 12.000</td>
                                    <td class="py-3 text-end fw-black text-success px-4">Rp 384.000</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-dark">Seblak Original Level 0</td>
                                    <td class="py-3 text-center fw-bold text-primary">15 Porsi</td>
                                    <td class="py-3 text-end text-muted">Rp 14.000</td>
                                    <td class="py-3 text-end fw-black text-success px-4">Rp 210.000</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden border-start border-primary border-5 bg-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark m-0">Asisten AI Warung Pintar</h5>
                            <p class="text-muted small m-0">Tanya apa saja soal perkembangan tokomu hari ini.</p>
                        </div>
                    </div>

                    <div id="box-chat-ai" class="bg-light rounded-3 p-3 mb-3 overflow-y-auto" style="height: 220px; border: 1px solid #eef2f3;">
                        <div class="d-flex gap-2 mb-3 align-items-start">
                            <div class="bg-primary text-white rounded-circle p-1.5 small"><i class="fas fa-robot fs-7"></i></div>
                            <div class="bg-white text-dark rounded-3 p-2.5 shadow-sm small border" style="max-width: 85%;">
                                Halo Bos! Aku asisten AI-mu. Ada yang bisa dibantu untuk ngecek jualan hari ini? Coba klik tombol otomatis di bawah atau ketik pertanyaanmu ya!
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-1.5 mb-3">
                        <button type="button" onclick="tanyaAI('Berapa total omset kita hari ini?')" class="btn btn-sm btn-outline-primary rounded-pill text-xs">💰 Cek Omset</button>
                        <button type="button" onclick="tanyaAI('Menu apa jagoan yang paling laku?')" class="btn btn-sm btn-outline-warning text-dark rounded-pill text-xs">🔥 Menu Terlaris</button>
                        <button type="button" onclick="tanyaAI('Apakah ada stok bahan baku yang mau habis?')" class="btn btn-sm btn-outline-danger rounded-pill text-xs">⚠️ Cek Bahan Kritis</button>
                        <button type="button" onclick="tanyaAI('Beri rekomendasi atau saran taktik bisnis')" class="btn btn-sm btn-outline-success rounded-pill text-xs">💡 Minta Saran Bisnis</button>
                    </div>

                    <div class="input-group">
                        <input type="text" id="input-pesan-user" class="form-control bg-light border-0 py-2.5 rounded-start-3 small" placeholder="Ketik pertanyaan di sini (misal: gimana kondisi stok?)..." onkeypress="if(event.key === 'Enter') kirimPesanManual()">
                        <button class="btn btn-primary px-4 rounded-end-3" type="button" onclick="kirimPesanManual()">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
// Ambil data PHP untuk dipakai di JavaScript grafik & chatbot
const dataDapurToko = {
    omset: '<?= $totalPenjualan ?>',
    totalMenu: '<?= $totalProduk ?>',
    stokKritis: <?= (int)$stokHampirHabis ?>,
    menuJuara: '<?= addslashes($produkTerlaris) ?>'
};

const boxChat = document.getElementById('box-chat-ai');

// TUNGGU HALAMAN SIAP, LALU GAMBAR GRAFIK
document.addEventListener("DOMContentLoaded", function() {
    
    // 1. SETTING GRAFIK LINE (TREN OMSET)
    const ctxOmset = document.getElementById('grafikOmset').getContext('2d');
    new Chart(ctxOmset, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Uang Masuk (Rp)',
                data: [450000, 620000, 580000, 710000, 950000, 1400000, 1250000], 
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.05)',
                fill: true,
                tension: 0.3,
                borderWidth: 3,
                pointBackgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // 2. SETTING GRAFIK DONUT (MENU TERLARIS)
    const ctxMenu = document.getElementById('grafikMenuTerlaris').getContext('2d');
    new Chart(ctxMenu, {
        type: 'doughnut',
        data: {
            labels: ['Seblak Lv 3', 'Piscok Keju', 'Seblak Ori'],
            datasets: [{
                data: [45, 32, 15], 
                backgroundColor: ['#ffc107', '#fd7e14', '#dc3545'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
});

// 3. FUNGSI UNDUH EXCEL
function eksporKeExcel() {
    const namaFile = 'Laporan_Penjualan_Warung_' + new Date().toISOString().slice(0,10) + '.xls';
    const tabelHtml = document.getElementById('tabelLaporanPenjualan').outerHTML;
    
    const templateExcel = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
        <head><meta charset="UTF-8"></head>
        <body>
            <h2>LAPORAN HASIL PENJUALAN TOKO KULINER</h2>
            <p>Tanggal Download: ${new Date().toLocaleDateString('id-ID')}</p>
            <br/>
            ${tabelHtml}
        </body>
        </html>
    `;

    const blobData = new Blob([templateExcel], { type: 'application/vnd.ms-excel' });
    
    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
        window.navigator.msSaveOrOpenBlob(blobData, namaFile);
    } else {
        const linkUnduh = document.createElement('a');
        linkUnduh.href = URL.createObjectURL(blobData);
        linkUnduh.download = namaFile;
        document.body.appendChild(linkUnduh);
        linkUnduh.click();
        document.body.removeChild(linkUnduh);
    }
}

// 4. LOGIKA ASISTEN AI
function tanyaAI(pertanyaan) {
    tampilkanBubble(pertanyaan, 'user');
    tampilkanBubble('<span class="text-muted italic animate-pulse">Sedang menganalisis data warung...</span>', 'loading-bot');

    setTimeout(() => {
        const loading = document.getElementById('bubble-loading');
        if (loading) loading.remove();

        let jawabanBot = "";
        const teks = pertanyaan.toLowerCase();

        if (teks.includes('omset') || teks.includes('uang') || teks.includes('pendapatan') || teks.includes('hasil')) {
            jawabanBot = `Laporan Keuangan Hari Ini: Total uang masuk (omset) kita saat ini tercatat sebesar <b>${dataDapurToko.omset}</b>. Perolehan ini sangat baik, pertahankan performa pelayanan kasir ya Bos!`;
        } 
        else if (teks.includes('laku') || teks.includes('laris') || teks.includes('jagoan') || teks.includes('terlaris') || teks.includes('favorit')) {
            jawabanBot = `Menu yang saat ini jadi bintang utama dan paling sering dipesan pembeli adalah <b>${dataDapurToko.menuJuara}</b>. Pastikan bahan-bahan pelengkap untuk menu ini selalu siap sedia di dapur utama karena peminatnya luar biasa banyak!`;
        } 
        else if (teks.includes('stok') || teks.includes('habis') || teks.includes('kritis') || teks.includes('bahan') || teks.includes('belanja')) {
            if (dataDapurToko.stokKritis > 0) {
                jawabanBot = `🚨 <b>PERINGATAN KRITIS:</b> Ada sekitar <b>${dataDapurToko.stokKritis} jenis bahan baku</b> yang jumlah porsinya sudah menyentuh batas aman (hampir habis). Saya sarankan segera lakukan restock/belanja pasar agar besok pagi kita tidak menolak pesanan pelanggan.`;
            } else {
                jawabanBot = `Kondisi gudang aman terkendali, Bos! Seluruh pasokan bahan baku makanan di sistem terpantau masih mencukupi untuk memenuhi kebutuhan porsi hari ini.`;
            }
        } 
        else if (teks.includes('saran') || teks.includes('taktik') || teks.includes('rekomendasi') || teks.includes('bisnis') || teks.includes('strategi')) {
            let opsiSaran = [
                `Taktik hari ini: Karena menu <b>${dataDapurToko.menuJuara}</b> lagi naik daun, coba tawarkan promo bundling (paket hemat) gabungan dengan minuman segar agar keuntungan per struk belanja makin berlipat ganda!`,
                `Saran operasional: Selalu pantau pergerakan kasir di jam sibuk (makan siang/malam). Pastikan stok ketersediaan bumbu rahasia seblak tidak mendadak kosong di jam tersebut.`,
                `Tips pemasaran: Coba buat konten video pendek berdurasi 15 detik yang menampilkan tingkat kepedasan level tinggi dari menu kita, lalu unggah ke TikTok/Reels untuk memicu kedatangan pelanggan baru.`
            ];
            jawabanBot = opsiSaran[Math.floor(Math.random() * opsiSaran.length)];
        } 
        else {
            jawabanBot = `Maaf Bos, saya belum begitu memahami pertanyaan itu. Coba ketik kata kunci seperti <b>'omset'</b>, <b>'menu laris'</b>, atau <b>'stok habis'</b>.`;
        }

        tampilkanBubble(jawabanBot, 'bot');
    }, 700);
}

function kirimPesanManual() {
    const inputField = document.getElementById('input-pesan-user');
    const pesan = inputField.value.trim();
    if(pesan === "") return;
    
    tanyaAI(pesan);
    inputField.value = "";
}

function tampilkanBubble(teks, sender) {
    const div = document.createElement('div');
    div.className = "d-flex gap-2 mb-3 align-items-start";
    
    if (sender === 'user') {
        div.className += " justify-content-end";
        div.innerHTML = `
            <div class="bg-primary text-white rounded-3 p-2.5 shadow-sm small" style="max-width: 85%;">
                ${teks}
            </div>
            <div class="bg-secondary text-white rounded-circle p-1.5 small"><i class="fas fa-user fs-7"></i></div>
        `;
    } else if (sender === 'loading-bot') {
        div.id = "bubble-loading";
        div.innerHTML = `
            <div class="bg-primary text-white rounded-circle p-1.5 small"><i class="fas fa-robot fs-7"></i></div>
            <div class="bg-white text-dark rounded-3 p-2.5 shadow-sm small border" style="max-width: 85%;">
                ${teks}
            </div>
        `;
    } else {
        div.innerHTML = `
            <div class="bg-primary text-white rounded-circle p-1.5 small"><i class="fas fa-robot fs-7"></i></div>
            <div class="bg-white text-dark rounded-3 p-2.5 shadow-sm small border" style="max-width: 85%;">
                ${teks}
            </div>
        `;
    }
    
    boxChat.appendChild(div);
    boxChat.scrollTop = boxChat.scrollHeight;
}
</script>

<style>
    .fw-black { font-weight: 800; }
    .tracking-tight { letter-spacing: -0.5px; }
    .tracking-wider { letter-spacing: 0.5px; }
    .hover-translate-y:hover { transform: translateY(-4px); transition: all 0.3s ease; }
    .fs-7 { font-size: 0.75rem; }
    .small-title { font-size: 0.875rem; text-uppercase: uppercase; letter-spacing: 0.5px;}
    .text-xs { font-size: 0.8rem; }
    .gap-1.5 { gap: 0.375rem; }
    .p-1.5 { padding: 0.375rem 0.5rem; }
    .p-2.5 { padding: 0.5rem 0.75rem; }
    .italic { font-style: italic; }
</style>

<?= view('layout/footer') ?>