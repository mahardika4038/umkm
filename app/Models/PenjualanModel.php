<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['produk_id', 'jumlah', 'total_harga', 'tanggal_penjualan'];
    protected $useTimestamps    = false;
}