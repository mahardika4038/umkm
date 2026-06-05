<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PenjualanModel; // Panggil model penjualan

class Dashboard extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $penjualanModel = new PenjualanModel();
        
        // 1. Ambil data produk untuk statistik ringkasan
        $semuaProduk = $produkModel->findAll();
        $stokMenipis = $produkModel->where('stok <=', 10)->findAll();

        // 2. HITUNG TOTAL PENDAPATAN (SUM dari kolom total_harga)
        $totalUang = $penjualanModel->selectSum('total_harga')->first();
        $nominalPenjualan = $totalUang['total_harga'] ?? 0;

        // 3. CARI PRODUK TERLARIS (GROUP BY produk_id dan ORDER BY total porsi terjual)
        $terlaris = $penjualanModel->select('produk_id, SUM(jumlah) as total_terjual')
                                   ->groupBy('produk_id')
                                   ->orderBy('total_terjual', 'DESC')
                                   ->first();

        $namaProdukTerlaris = 'Belum Ada Transaksi';
        if ($terlaris) {
            $dataProdukTerlaris = $produkModel->find($terlaris['produk_id']);
            if ($dataProdukTerlaris) {
                $namaProdukTerlaris = $dataProdukTerlaris['nama_produk'] . ' (' . $terlaris['total_terjual'] . ' Porsi)';
            }
        }

        // 4. Kirim seluruh data dinamis ke halaman view dashboard
        $data = [
            'title'              => 'Dashboard UMKM Makanan',
            'produk'             => $semuaProduk, 
            'totalProduk'        => count($semuaProduk),
            'stokHampirHabis'    => count($stokMenipis),
            'produkKritis'       => $stokMenipis, 
            
            // Sekarang nilai di bawah ini sudah diambil langsung dari database secara otomatis
            'totalPenjualan'     => 'Rp ' . number_format($nominalPenjualan, 0, ',', '.'), 
            'produkTerlaris'     => $namaProdukTerlaris,
        ];

        return view('dashboard', $data);
    }
}