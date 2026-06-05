<?= view('layout/header') ?>

<h2>⚙️ <?= $title ?></h2>
<a href="/produk" style="color: #555; text-decoration: none;">⬅️ Kembali ke Kelola Produk</a>
<hr>

<div style="display: flex; gap: 30px; margin-top: 20px;">
    
    <div style="flex: 1; max-width: 350px; background: #f9f9f9; padding: 20px; border-radius: 6px; border: 1px solid #eee; height: fit-content;">
        <h3>➕ Tambah Bahan Masakan</h3>
        <form action="/produk/resep/simpan/<?= $produk['id'] ?>" method="post">
            <?= csrf_field(); ?>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Pilih Bahan Baku</label>
                <select name="bahan_id" required style="width: 100%; padding: 8px; border-radius: 4px;">
                    <option value="">-- Pilih Bahan --</option>
                    <?php foreach ($bahanBaku as $bb): ?>
                        <option value="<?= $bb['id'] ?>"><?= $bb['nama_bahan'] ?> (<?= $bb['satuan'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Takaran Kebutuhan (Per Porsi)</label>
                <input type="number" name="jumlah_dibutuhkan" required min="1" placeholder="Contoh: 5" style="width: 93%; padding: 8px; border-radius: 4px; border: 1px solid #ccc;">
            </div>

            <button type="submit" style="background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%;">💾 Masukkan ke Resep</button>
        </form>
    </div>

    <div style="flex: 2;">
        <h3>📋 Komposisi Resep Saat Ini</h3>
        <table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th width="50">No</th>
                    <th>Nama Bahan Baku</th>
                    <th width="150">Kebutuhan / Porsi</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarResep)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: #888;">Resep belum diatur. Silakan tambah bahan di form kiri.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($daftarResep as $dr): ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= $dr['nama_bahan'] ?></td>
                        <td style="text-align: center; font-weight: bold;"><?= $dr['jumlah_dibutuhkan'] ?> <?= $dr['satuan'] ?></td>
                        <td style="text-align: center;">
                            <a href="/produk/resep/hapus/<?= $dr['id'] ?>/<?= $produk['id'] ?>" onclick="return confirm('Hapus <?= $dr['nama_bahan'] ?> dari resep ini?')" style="background-color: #dc3545; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 13px;">🗑️ Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= view('layout/footer') ?>