<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanBakuModel extends Model
{
    protected $table            = 'bahan_baku';
    protected $primaryKey       = 'id';
    // Diubah agar pas dengan kolom baru di phpMyAdmin tadi
    protected $allowedFields    = ['nama_bahan', 'stok', 'minimal_stok', 'satuan'];
    protected $useTimestamps    = false;
}