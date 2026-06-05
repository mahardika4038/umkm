<?php

namespace App\Controllers;

// Pastikan mewarisi BaseController agar fitur CodeIgniter berjalan normal
class Laporan extends BaseController
{
    // Fungsi ini WAJIB bernama 'index' dengan huruf kecil semua
    public function index()
    {
        $penjualanModel = new \App\Models\PenjualanModel();
        
        // Ambil semua data riwayat penjualan, urutkan dari yang terbaru
        $data['laporan'] = $penjualanModel->orderBy('tanggal', 'DESC')->findAll();
        $data['title'] = 'Laporan Penjualan';

        // Gabungkan dan kembalikan view
        return view('layout/header', $data)
             . view('laporan/index', $data)
             . view('layout/footer');
    }
}