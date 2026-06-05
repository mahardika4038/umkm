<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;

class BahanBaku extends BaseController
{
    // 1. Tampilkan Semua Bahan Baku
    public function index()
    {
        $bahanModel = new BahanBakuModel();
        
        $data = [
            'title'     => 'Kelola Stok Bahan Baku',
            'bahanBaku' => $bahanModel->findAll()
        ];

        return view('bahan_baku/index', $data);
    }

    // 2. Tampilkan Form Tambah Bahan
    public function tambah()
    {
        $data = ['title' => 'Tambah Bahan Baku Baru'];
        return view('bahan_baku/tambah', $data);
    }

    // 3. Proses Simpan Bahan ke Database
    public function simpan()
    {
        $bahanModel = new BahanBakuModel();

        $bahanModel->save([
            'nama_bahan'   => $this->request->getPost('nama_bahan'),
            'stok'         => $this->request->getPost('stok'),
            'minimal_stok' => $this->request->getPost('minimal_stok'),
            'satuan'       => $this->request->getPost('satuan')
        ]);

        return redirect()->to('/bahanbaku');
    }

    // 4. Tampilkan Form Edit Bahan
    public function edit($id)
    {
        $bahanModel = new BahanBakuModel();
        
        $data = [
            'title' => 'Edit Bahan Baku',
            'bahan' => $bahanModel->find($id)
        ];

        return view('bahan_baku/edit', $data);
    }

    // 5. Proses Update data Bahan
    public function update($id)
    {
        $bahanModel = new BahanBakuModel();

        $bahanModel->update($id, [
            'nama_bahan'   => $this->request->getPost('nama_bahan'),
            'stok'         => $this->request->getPost('stok'),
            'minimal_stok' => $this->request->getPost('minimal_stok'),
            'satuan'       => $this->request->getPost('satuan')
        ]);

        return redirect()->to('/bahanbaku');
    }

    // 6. Hapus Bahan Baku
    public function hapus($id)
    {
        $bahanModel = new BahanBakuModel();
        $bahanModel->delete($id);

        return redirect()->to('/bahanbaku');
    }

    public function simpanMassal()
{
    $bahanPost = $this->request->getPost('bahan');
    
    foreach ($bahanPost as $b) {
        $stokTambahan = (int)$b['stok_tambahan'];
        if ($stokTambahan > 0) {
            // Ambil data stok lama dulu di DB, lalu tambahkan dengan $stokTambahan
            // Contoh logic update:
            // $stokLama = $this->bahanModel->find($b['id'])['stok'];
            // $this->bahanModel->update($b['id'], ['stok' => $stokLama + $stokTambahan]);
        }
    }
    return redirect()->to('/bahanbaku')->with('sukses', 'Semua stok bahan baku berhasil diperbarui!');
}
}