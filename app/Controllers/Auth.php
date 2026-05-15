<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $db;

    public function __construct()
    {
        // Inisialisasi database
        $this->db = \Config\Database::connect();
    }

public function login()
{
    // Cek apakah user sudah punya sesi login
    if (session()->get('logged_in')) {
        // Jika Guru, lempar ke Rekap
        if (session()->get('role') === 'guru') {
            return redirect()->to('/izin/rekap');
        }
        // Jika Siswa, lempar ke Form Izin
        return redirect()->to('/izin');
    }

    return view('login');
}
public function proses_login()
{
    // Tangkap inputan form (mau itu NIS atau NIK masuknya ke sini)
    $id_login = trim((string)$this->request->getPost('id_login'));
    $password = trim((string)$this->request->getPost('password'));

    // Langsung tembak ke kolom 'username'
    $user = $this->db->table('users')->where('username', $id_login)->get()->getRowArray();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            
            // Simpan ke session memori
            session()->set([
                'nis'       => $user['username'], // Tetap pakai nama 'nis' biar form izin lama gak error
                'nama'      => $user['nama'],     // Simpan nama aslinya
                'role'      => $user['role'],
                'logged_in' => true
            ]);

            // Deteksi otomatis lempar ke mana
            return ($user['role'] === 'guru') 
                ? redirect()->to('/izin/rekap') 
                : redirect()->to('/izin');
        }
    }

    return redirect()->back()->with('error', 'NIS/NIK atau Password salah!');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('https://izin.purujekuto.biz.id/');
    }

}