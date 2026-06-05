<?= view('layout/header') ?>

<h1><?= $title ?></h1>
<hr>

<div style="max-width: 500px; margin-top: 20px;">
    <form action="/produk/update/<?= $produk['id'] ?>" method="post">
        <?= csrf_field(); ?>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Nama Produk</label>
            <input type="text" name="nama_produk" value="<?= $produk['nama_produk'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Harga (Rp)</label>
            <input type="number" name="harga" value="<?= $produk['harga'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Stok</label>
            <input type="number" name="stok" value="<?= $produk['stok'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Kategori ID</label>
            <input type="number" name="kategori_id" value="<?= $produk['kategori_id'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">
            🆙 Perbarui Produk
        </button>
        <a href="/produk" style="display: inline-block; margin-left: 10px; color: #555; text-decoration: none;">Batal</a>
    </form>
</div>

<?= view('layout/footer') ?>