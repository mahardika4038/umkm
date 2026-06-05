<?php

namespace App\Controllers;

class Pengaturan extends BaseController
{
    public function index()
    {
        // Data ini idealnya diambil dari database table 'pengaturan', 
        // tapi ini saya buatkan default array dulu agar langsung tampil & bisa kamu pakai.
        $data = [
            'title' => 'Pengaturan Sistem',
            'toko'  => [
                'nama_toko'     => 'Warung Seblak & Piscok Juara',
                'telepon'       => '081234567890',
                'alamat'        => 'Jl. Kuliner Pedas No. 45, Kota Bandung',
                'note_struk'    => 'Terima kasih sudah jajan di tempat kami! Ditunggu kedatangan berikutnya.',
                'pajak'         => 0, // Dalam persen (%)
                'alert_stok'    => 5  // Default min. stok bahan baku
            ]
        ];

        return view('pengaturan', $data);
    }

    public function simpan()
    {
        // Tempat memproses update ke database nanti jika sudah pakai model.
        // Untuk sekarang, kita arahkan kembali dengan notifikasi sukses terpampang.
        
        // $namaToko = $this->request->getPost('nama_toko');
        
        session()->setFlashdata('sukses', 'Pengaturan toko berhasil diperbarui!');
        return redirect()->to('/pengaturan');
    }
}