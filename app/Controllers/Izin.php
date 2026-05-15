<?php

namespace App\Controllers;

use App\Models\IzinModel;
use TCPDF;

class Izin extends BaseController
{
    protected $izinModel;

    public function __construct() {
        $this->izinModel = new IzinModel();
    }

    // Halaman untuk Murid
    public function index() {
        if (session()->get('role') !=='siswa'){
            return "halaman ini khusus untuk siswa yang sudah login";
        }
        return view('form_izin');
    }

    // Halaman untuk Guru (Hanya bisa dibuka jika sudah login)
    public function rekap() {
        // Proteksi: Jika bukan guru, tendang balik ke form atau halaman login
        if (session()->get('role') !== 'guru') {
            return redirect()->to('/izin')->with('error', 'Akses ditolak!');
        }

        $data['izin'] = $this->izinModel->orderBy('created_at', 'DESC')->findAll();
        return view('izin_rekap', $data);
    }
   public function simpan()
    {
        // 1. Ambil data dari form
        $data = [
            'nis'       => $this->request->getPost('nis'),
            'nama'       => $this->request->getPost('nama'),
            'jenis_izin' => $this->request->getPost('jenis_izin'),
            'alasan'     => $this->request->getPost('alasan'),
            'jam_mulai'  => $this->request->getPost('jam_mulai'),
            'jam_selesai'=> $this->request->getPost('jam_selesai'),
            'status'     => 'Proses' // Status awal otomatis 'Proses'
        ];

        // 2. Simpan ke database via Model
        if ($this->izinModel->insert($data)) {
            // Jika berhasil, arahkan ke halaman utama dengan pesan sukses
            return redirect()->to('/izin')->with('pesan', 'Izin berhasil dikirim!');
        } else {
            // Jika gagal
            return redirect()->back()->with('error', 'Gagal mengirim izin.');
        }
    }

    public function login_guru() {
        session()->set(['role' => 'guru', 'logged_in' => true]);
        return "Sekarang kamu login sebagai Guru. <a href='/izin/rekap'>Buka Rekap</a>";
    }
    
    public function logout() {
        session()->destroy();
        return "Berhasil logout. <a href='/izin'>Kembali ke Form</a>";
        }
        public function update_status($id, $status)
{
    // Pastikan hanya guru yang bisa akses
    if (session()->get('role') !== 'guru') {
        return redirect()->to('/izin');
    }

    $this->izinModel->update($id, ['status' => $status]);

    return redirect()->to('/izin/rekap')->with('pesan', 'Status izin siswa berhasil diperbarui!');
}

// Fungsi untuk menyetujui izin
public function setujui($id)
{
    $model = new \App\Models\IzinModel(); // Sesuaikan nama modelmu
    
    $model->update($id, [
        'status'    => 'Disetujui',
        'nama_guru' => session()->get('nama') // Otomatis narik nama guru yang lagi login!
    ]);

    return redirect()->to('/izin/rekap')->with('pesan', 'Izin disetujui!');
}

public function tolak($id)
{
    $model = new \App\Models\IzinModel(); 
    
    $model->update($id, [
        'status'    => 'Ditolak',
        'nama_guru' => session()->get('nama')
    ]);

    return redirect()->to('/izin/rekap')->with('pesan', 'Izin ditolak!');
}

public function cetak_pdf($id)
{
    $data = $this->izinModel->find($id); 

    if (!$data) {
        return "Data tidak ditemukan!";
    }

    $pdf = new \TCPDF('P', 'mm', 'A5', true, 'UTF-8', false); 
    $pdf->SetCreator('E-Izin Purujekuto');
    $pdf->SetTitle('Surat Izin Keluar - ' . $data['nama']);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(15, 15, 15); // Kasih margin biar rapi
    $pdf->AddPage();

    // Link validasi untuk QR Code
    $linkValidasi = base_url('izin/validasi/' . $data['id']);
    // URL API QR Code (Ukuran 150x150)
    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . $linkValidasi;

    // Konten HTML
    $html = '
        <h2 style="text-align:center;">SURAT IZIN KELUAR</h2>
        <h4 style="text-align:center; font-weight:normal;">SMK Negeri 2 PEKALONGAN</h4>
        <hr>
        <br><br>
        <p>Diberikan izin kepada siswa berikut:</p>
        <table border="0" cellpadding="5">
            <tr><td width="30%"><b>Nama Siswa</b></td><td width="5%">:</td><td width="65%">'.$data['nama'].'</td></tr>
            <tr><td><b>NIS</b></td><td>:</td><td>'.$data['nis'].'</td></tr>
            <tr><td><b>Jenis Izin</b></td><td>:</td><td>'.$data['jenis_izin'].'</td></tr>
            <tr><td><b>Alasan</b></td><td>:</td><td>'.$data['alasan'].'</td></tr>
            <tr><td><b>Waktu Izin</b></td><td>:</td><td>Jam ke-'.$data['jam_mulai'].' s/d '.$data['jam_selesai'].'</td></tr>
            <tr><td><b>Status</b></td><td>:</td><td><b>'.$data['status'].'</b></td></tr>
        </table>
        <br><br><br>

        <table border="0" cellpadding="0">
            <tr>
                <td width="50%" style="text-align:center;">
                    <p style="font-size:8pt;">Scan untuk validasi:</p>
                    <img src="'.$qrCodeUrl.'" width="80" height="80">
                </td>
                
                <td width="50%" style="text-align:center;">
                    Mengetahui,<br>
                    Guru Piket/Pengajar<br><br><br><br>
                    <b>( '.(!empty($data['nama_guru']) ? $data['nama_guru'] : '............................').' )</b>
                </td>
            </tr>
        </table>
        
        <br><br>
        <p style="font-size:8pt; color:gray; text-align:center;"><i>Surat ini dicetak otomatis oleh Sistem E-Izin pada '.date('d/m/Y H:i').'</i></p>
    ';

    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Output PDF ke browser
    $this->response->setHeader('Content-Type', 'application/pdf');
    $pdf->Output('surat_izin_'.$data['nama'].'.pdf', 'I');
}
public function status()
{
    $model = new IzinModel(); // Sesuaikan nama model
    
    // Asumsinya kamu menyimpan 'nis' siswa di session saat mereka login
    $nis_siswa = session()->get('nis'); 

    // Ambil data izin HANYA untuk siswa ini
    $data['izin'] = $model->where('nis', $nis_siswa)->orderBy('id', 'DESC')->findAll();

    // Tampilkan ke view khusus status siswa
    return view('status_siswa', $data); 
}
public function validasi($id)
{
    $model = new \App\Models\IzinModel();
    
    // Cari data izin berdasarkan ID yang ada di QR Code
    $data['izin'] = $model->find($id);

    // Kalau ada orang iseng scan QR code palsu / datanya udah dihapus
    if (!$data['izin']) {
        return "Surat Izin Tidak Valid / Data Tidak Ditemukan di Database!";
    }

    // Kalau datanya ada, lempar ke halaman view validasi buat Satpam
    return view('validasi', $data);
}
}