<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminOnlyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika akun yang login BUKAN superadmin, tendang balik ke dashboard dengan pesan peringatan
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak! Halaman ini hanya untuk Admin/Owner.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosongkan saja
    }
}