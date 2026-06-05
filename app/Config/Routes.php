<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Matikan auto routing jika mengganggu defined routes
$routes->setAutoRoute(false);

// =========================================================================
// 1. RUTE AUTENTIKASI (LOGIN & LOGOUT) - Terbuka untuk semua
// =========================================================================
$routes->get('/', '\App\Controllers\Auth::login'); 
$routes->get('login', '\App\Controllers\Auth::login');
$routes->post('login/proses', '\App\Controllers\Auth::loginProses');
$routes->get('logout', '\App\Controllers\Auth::logout');

// =========================================================================
// 2. RUTE GLOBAL (Superadmin & Karyawan setelah Login)
// =========================================================================
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Dashboard, Kasir Penjualan & Laporan
    $routes->get('dashboard', '\App\Controllers\Dashboard::index');
    $routes->get('penjualan', '\App\Controllers\Penjualan::index');
    $routes->post('penjualan/simpan', '\App\Controllers\Penjualan::simpan');
    $routes->get('laporan', '\App\Controllers\Laporan::index'); 

    // Hak Akses Melihat Data
    $routes->get('produk', '\App\Controllers\Produk::index');
    $routes->get('bahanbaku', '\App\Controllers\BahanBaku::index');
    $routes->post('bahanbaku/simpanMassal', 'BahanBaku::simpanMassal');

    // pengaturan
    $routes->get('pengaturan', 'Pengaturan::index');
    $routes->post('pengaturan/simpan', 'Pengaturan::simpan');   

    // =========================================================================
    // 3. RUTE KHUSUS SUPERADMIN (Owner / Hak Akses Penuh)
    // =========================================================================
    $routes->group('', ['filter' => 'adminonly'], function($routes) {
        
        // Aksi Kelola Produk
        $routes->get('produk/tambah', '\App\Controllers\Produk::tambah');
        $routes->post('produk/simpan', '\App\Controllers\Produk::simpan');
        $routes->get('produk/edit/(:num)', '\App\Controllers\Produk::edit/$1');
        $routes->post('produk/update/(:num)', '\App\Controllers\Produk::update/$1');
        $routes->get('produk/hapus/(:num)', '\App\Controllers\Produk::hapus/$1');

        // Aksi Integrasi UI Resep
        $routes->get('produk/resep/(:num)', '\App\Controllers\Produk::resep/$1');
        $routes->post('produk/resep/simpan/(:num)', '\App\Controllers\Produk::simpanResep/$1');
        $routes->get('produk/resep/hapus/(:num)/(:num)', '\App\Controllers\Produk::hapusResep/$1/$2');

        // Aksi Kelola Stok Bahan Baku
        $routes->get('bahanbaku/tambah', '\App\Controllers\BahanBaku::tambah');
        $routes->post('bahanbaku/simpan', '\App\Controllers\BahanBaku::simpan');
        $routes->get('bahanbaku/edit/(:num)', '\App\Controllers\BahanBaku::edit/$1');
        $routes->post('bahanbaku/update/(:num)', '\App\Controllers\BahanBaku::update/$1');
        $routes->get('bahanbaku/hapus/(:num)', '\App\Controllers\BahanBaku::hapus/$1');
    });

});