# 🏫 E-Izin Sekolah - Sistem Manajemen Perizinan Siswa

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

E-Izin adalah aplikasi berbasis web yang dirancang untuk mendigitalisasi proses perizinan siswa keluar kelas atau lingkungan sekolah. Dibangun dengan framework **CodeIgniter 4**, aplikasi ini memangkas birokrasi kertas manual menjadi sistem elektronik yang cepat, transparan, dan aman dilengkapi dengan verifikasi QR Code.

## ✨ Fitur Unggulan

Aplikasi ini mendukung *Multi-Role* dengan fungsi spesifik untuk masing-masing pengguna:

### 🧑‍🎓 Panel Siswa
* **Pengajuan Mandiri:** Siswa dapat mengajukan izin dengan mengisi alasan dan jam keluar.
* **Tracking Status Real-time:** Memantau status izin apakah masih menunggu, disetujui, atau ditolak oleh guru.
* **Cetak Surat Otomatis (PDF):** Jika disetujui, siswa dapat mencetak surat izin dalam format PDF.
* **Keamanan QR Code:** Surat PDF dilengkapi QR Code unik untuk mencegah pemalsuan.

### 👨‍🏫 Panel Guru / Pengajar
* **Approval System:** Guru dapat mengeksekusi (Setujui/Tolak) pengajuan izin siswa dengan satu klik.
* **Rekapitulasi DataTables:** Daftar riwayat perizinan yang rapi dengan fitur pencarian (*search*), filter, dan *pagination* yang responsif.
* **Digital Footprint:** Nama guru yang menyetujui akan terekam dan tercetak otomatis di surat siswa.

### 👮‍♂️ Panel Validasi (Satpam/Gerbang)
* **Scan & Go:** Petugas keamanan gerbang cukup melakukan *scan* QR Code pada surat izin siswa menggunakan kamera HP.
* **Validasi Anti-Palsu:** Sistem akan menampilkan halaman verifikasi berwarna hijau (VALID) beserta detail jam dan guru penyetuju, atau merah (TIDAK VALID) jika surat dipalsukan.

---

## 🔄 Skenario Penggunaan (Workflow)
1. **Siswa** mengajukan form izin via aplikasi.
2. **Guru** melihat notifikasi/tabel rekap, lalu menekan tombol **Setujui**.
3. **Siswa** melihat status berubah menjadi hijau dan menekan tombol **Cetak Surat**.
4. **Siswa** menunjukkan surat PDF (di HP atau dicetak) ke **Satpam**.
5. **Satpam** melakukan *scan* QR Code untuk memvalidasi keaslian surat sebelum membukakan gerbang.

---

## 🛠️ Teknologi yang Digunakan
* **Backend:** PHP 8, CodeIgniter 4
* **Frontend:** Bootstrap 5, FontAwesome, DataTables (jQuery)
* **Database:** MySQL / MariaDB
* **Library Tambahan:** TCPDF (Untuk *Generate* Surat PDF), QR Server API.

---

## 🚀 Cara Instalasi & Penggunaan Lokal

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer / server lokal (XAMPP/Laragon/dll):

1. **Clone Repository ini**
   ```bash
   git clone [https://github.com/](https://github.com/)[username-github-kamu]/[nama-repo-kamu].git
   cd [nama-repo-kamu]
Konfigurasi Database

Buat database baru di MySQL/phpMyAdmin (misal: db_eizin).

Import file database yang tersedia di folder database/db_eizin.sql (jika ada).

Rename file env menjadi .env.

Buka file .env, cari pengaturan database, hapus tanda #, dan sesuaikan:

Cuplikan kode
database.default.hostname = localhost
database.default.database = db_eizin
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
Jalankan Aplikasi
Buka terminal di dalam folder project dan jalankan built-in server CodeIgniter:

Bash
php spark serve
Aplikasi bisa diakses melalui browser di: http://localhost:8080
