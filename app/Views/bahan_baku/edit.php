<?= view('layout/header') ?>

<h1><?= $title ?></h1>
<hr>

<div style="max-width: 500px; margin-top: 20px;">
    <form action="/bahanbaku/update/<?= $bahan['id'] ?>" method="post">
        <?= csrf_field(); ?>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Nama Bahan Baku</label>
            <input type="text" name="nama_bahan" value="<?= $bahan['nama_bahan'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Stok</label>
            <input type="number" name="stok" value="<?= $bahan['stok'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Minimal Stok</label>
            <input type="number" name="minimal_stok" value="<?= $bahan['minimal_stok'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Satuan</label>
            <input type="text" name="satuan" value="<?= $bahan['satuan'] ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">🆙 Perbarui Bahan</button>
        <a href="/bahanbaku" style="display: inline-block; margin-left: 10px; color: #555; text-decoration: none;">Batal</a>
    </form>
</div>

<?= view('layout/footer') ?>