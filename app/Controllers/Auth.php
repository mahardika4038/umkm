<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, langsung lempar ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login', ['title' => 'Login Sistem UMKM']);
    }

   public function loginProses()
    {
        $userModel = new UserModel();
        $username  = $this->request->getPost('username');
        $password  = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            // KUNCI JALUR PINTAS: Langsung bandingkan teks biasa (admin123 == admin123)
            if ($password === $user['password']) {
                
                // Set data ke dalam session aplikasi
                session()->set([
                    'id'        => $user['id'],
                    'username'  => $user['username'],
                    'role'      => $user['role'],
                    'logged_in' => true
                ]);
                return redirect()->to('/dashboard');

            } else {
                return redirect()->back()->with('error', 'Password salah! Di database terdaftar: ' . $user['password']);
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak terdaftar!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}