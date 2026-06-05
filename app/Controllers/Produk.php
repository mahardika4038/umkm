<?php

namespace App\Controllers;

// Memanggil semua model yang dibutuhkan aplikasi
use App\Models\ProdukModel; 
use App\Models\BahanBakuModel;
use App\Models\ResepModel;

class Produk extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        
        // Mengambil semua data produk dari database
        $semuaProduk = $produkModel->findAll(); 

        // Bungkus semua data ke dalam satu array $data
        $data = [
            'title'       => 'Daftar Produk Toko',
            'totalProduk' => count($semuaProduk),
            'produk'      => $semuaProduk
        ];

        // Kirim array $data ke view produk Anda
        return view('produk/index', $data); 
    }

    // Fungsi untuk menampilkan halaman Form Tambah Produk
    public function tambah()
    {
        $data = [
            'title' => 'Tambah Produk Baru'
        ];
        return view('produk/tambah', $data);
    }

    // Fungsi untuk memproses data dari Form ke Database
    public function simpan()
    {
        $produkModel = new ProdukModel();

        // Ambil data dari inputan form
        $produkModel->save([
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'kategori_id' => $this->request->getPost('kategori_id'), // Sementara diisi manual dulu
            'gambar'      => 'default.jpg' // Default jika belum upload gambar
        ]);

        // Jika berhasil, kembalikan ke halaman daftar produk (/produk)
        return redirect()->to('/produk');
    }

    // Fungsi untuk menampilkan halaman Form Edit Produk beserta datanya
    public function edit($id)
    {
        $produkModel = new ProdukModel();
        
        $data = [
            'title'  => 'Edit Produk',
            'produk' => $produkModel->find($id) // Ambil 1 data produk berdasarkan ID
        ];

        return view('produk/edit', $data);
    }

    // Fungsi untuk memproses Update data ke database
    public function update($id)
    {
        $produkModel = new ProdukModel();

        $produkModel->update($id, [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'kategori_id' => $this->request->getPost('kategori_id')
        ]);

        return redirect()->to('/produk');
    }

    // Fungsi untuk menghapus data produk
    public function hapus($id)
    {
        $produkModel = new ProdukModel();
        $produkModel->delete($id);

        return redirect()->to('/produk');
    }

    // =========================================================================
    // FITUR TAMBAHAN BARU: KELOLA UI RESEP (INTEGRASI STOK)
    // =========================================================================

    // 1. Halaman Tampil & Tambah Resep per Produk
    public function resep($produk_id)
    {
        $produkModel = new ProdukModel();
        $bahanModel  = new BahanBakuModel();

        // Ambil data resep gabungan dengan nama bahan baku menggunakan Query Builder Join
        $db      = \Config\Database::connect();
        $builder = $db->table('resep');
        $builder->select('resep.*, bahan_baku.nama_bahan, bahan_baku.satuan');
        $builder->join('bahan_baku', 'bahan_baku.id = resep.bahan_id');
        $builder->where('resep.produk_id', $produk_id);
        $daftarResep = $builder->get()->getResultArray();

        $data = [
            'title'       => 'Kelola Resep ' . $produkModel->find($produk_id)['nama_produk'],
            'produk'      => $produkModel->find($produk_id),
            'daftarResep' => $daftarResep,
            'bahanBaku'   => $bahanModel->findAll() // Untuk pilihan dropdown form
        ];

        return view('produk/resep', $data);
    }

    // 2. Proses Simpan Bahan ke Dalam Resep Produk
    public function simpanResep($produk_id)
    {
        $resepModel = new ResepModel();

        $resepModel->save([
            'produk_id'         => $produk_id,
            'bahan_id'          => $this->request->getPost('bahan_id'),
            'jumlah_dibutuhkan' => $this->request->getPost('jumlah_dibutuhkan')
        ]);

        return redirect()->to('/produk/resep/' . $produk_id);
    }

    // 3. Proses Hapus Bahan dari Resep
    public function hapusResep($id, $produk_id)
    {
        $resepModel = new ResepModel();
        $resepModel->delete($id);

        return redirect()->to('/produk/resep/' . $produk_id);
    }
}