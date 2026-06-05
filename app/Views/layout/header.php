<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Aplikasi Kasir UMKM' ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* SIDEBAR MINIMALIS: Hanya berupa bar kecil di kiri untuk menampung tombol titik tiga */
        .sidebar-trigger-bar {
            background: rgba(255, 255, 255, 0.45) !important; /* Transparan */
            backdrop-filter: blur(10px); /* Efek Blur Kaca */
            -webkit-backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.25);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.01);
        }

        /* TOMBOL TITIK TIGA UTAMA (CLEAN & ELEGANT) */
        .btn-trigger-menu {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #495057;
            font-size: 20px;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-trigger-menu:hover {
            background: rgba(13, 110, 253, 0.08);
            color: #0d6efd;
            transform: scale(1.05);
        }

        /* CONTAINER MENU YANG MELUNCUR KELUAR (OFFCANVAS) */
        .glass-menu-canvas {
            background: rgba(255, 255, 255, 0.75) !important; /* Sangat transparan & clean */
            backdrop-filter: blur(20px) !important; /* Efek blur kaca tebal */
            -webkit-backdrop-filter: blur(20px) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05) !important;
            /* Mengatur animasi meluncur halus dari atas ke bawah */
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important; 
        }

        /* JUDUL DI DALAM KANVAS MENU */
        .menu-title-pos {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #212529;
        }

        /* ITEM LINK MENU KASIR, DASHBOARD, DLL */
        .menu-link-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: #495057;
            font-weight: 600;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.25s ease;
            margin-bottom: 8px;
        }
        .menu-link-item:hover {
            background: rgba(13, 110, 253, 0.08);
            color: #0d6efd;
            transform: translateX(4px);
        }
        .menu-link-item.active {
            background: #ffffff;
            color: #0d6efd;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
        }
        .menu-link-item i {
            width: 24px;
            font-size: 16px;
        }

        /* AREA KONTEN UTAMA */
        .main-content-modern {
            padding: 30px;
            background-color: #f8f9fa;
        }

        /* RESPONSIVE UNTUK LAYAR HANDPHONE */
        @media (max-width: 768px) {
            .sidebar-trigger-bar {
                min-height: auto;
                width: 100% !important;
                flex-direction: row !important;
                justify-content: space-between;
                padding: 10px 20px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.25);
                position: sticky;
                top: 0;
                z-index: 1000;
            }
            .main-content-modern {
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        
        <div class="col-12 col-md-1 col-lg-1 sidebar-trigger-bar" style="width: 70px;">
            
            <button class="btn-trigger-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSmartMenu" aria-controls="offcanvasSmartMenu">
                <i class="fas fa-ellipsis-v"></i> </button>
            
            <div class="mt-auto d-none d-md-block opacity-25 fw-bold text-secondary small" style="letter-spacing: 1px; transform: rotate(-90deg); margin-bottom: 30px; white-space: nowrap;">
                POS SYSTEM
            </div>
        </div> 

        <div class="offcanvas offcanvas-top glass-menu-canvas h-auto" tabindex="-1" id="offcanvasSmartMenu" aria-labelledby="offcanvasSmartMenuLabel">
            <div class="offcanvas-header container py-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                        <i class="fas fa-store small"></i>
                    </div>
                    <h5 class="offcanvas-title menu-title-pos fs-5" id="offcanvasSmartMenuLabel">Navigasi POS-UMKM</h5>
                </div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body container pb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-3">
                        <a href="/dashboard" class="menu-link-item">
                            <i class="fas fa-chart-pie text-secondary"></i> Dashboard Utama
                        </a>
                    </div>
                    <div class="col-12 col-md-3">
                        <a href="/penjualan" class="menu-link-item active">
                            <i class="fas fa-cash-register text-primary"></i> Menu Kasir (POS)
                        </a>
                    </div>
                    <div class="col-12 col-md-3">
                        <a href="/produk" class="menu-link-item">
                            <i class="fas fa-boxes text-secondary"></i> Manajemen Produk
                        </a>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="d-flex gap-2">
                            <a href="/pengaturan" class="menu-link-item flex-grow-1" style="margin-bottom: 0;"><i class="fas fa-cog text-secondary"></i></a>
                            <a href="/logout" class="menu-link-item btn btn-outline-danger border-0 flex-grow-1" style="margin-bottom: 0; background: rgba(220, 53, 69, 0.05); color: #dc3545;"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="col main-content-modern">
    <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width: 1400px;">