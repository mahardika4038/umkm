<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepModel extends Model
{
    protected $table            = 'resep';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['produk_id', 'bahan_id', 'jumlah_dibutuhkan'];
    protected $useTimestamps    = false;
}