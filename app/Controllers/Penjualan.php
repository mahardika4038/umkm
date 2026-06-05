<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\PenjualanModel; // <-- PASTIKAN BARIS INI ADA!

class Penjualan extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->findAll();
        $data['title'] = 'Menu Kasir';

        return view('layout/header', $data)
             . view('penjualan/index', $data)
             . view('layout/footer');
    }

    public function simpan()
    {
        $produkIds = $this->request->getPost('produk_id');
        $jumlahBeli = $this->request->getPost('jumlah');

        if (empty($produkIds)) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        $produkModel = new ProdukModel();
        $penjualanModel = new PenjualanModel(); // <-- Sudah aman karena file fisik sudah ada

        $totalBayar = 0;
        foreach ($produkIds as $index => $id) {
            $produk = $produkModel->find($id);
            if ($produk) {
                $totalBayar += $produk['harga'] * $jumlahBeli[$index];
                
                // Potong stok produk
                $stokBaru = $produk['stok'] - $jumlahBeli[$index];
                $produkModel->update($id, ['stok' => $stokBaru]);
            }
        }

        // Simpan ke tabel penjualan ringkas
        $penjualanModel->insert([
            'invoice'     => 'INV-' . date('YmdHis'),
            'total_harga' => $totalBayar,
            'tanggal'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('penjualan')->with('sukses', 'Transaksi Berhasil Disimpan!');
    }
}