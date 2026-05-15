    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <img src="https://cdn-icons-png.flaticon.com/512/2942/2942503.png" width="30" class="me-2">
            E-Izin Siswa
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="25" class="rounded-circle me-2">
                        <?= session()->get('nama') ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile Saya</a></li>
                        <a class="dropdown-item" href="<?= base_url('izin/status'); ?>">Status Izin</a>                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2>Form Izin Siswa</h2>
    <form action="/izin/simpan" method="post">
        <?= csrf_field(); ?>
        
<div class="mb-3">
    <label>NIS</label>
    <input type="text" name="nis" class="form-control bg-light" 
           value="<?= session()->get('nis'); ?>" readonly>
</div>

<div class="mb-3">
    <label>Nama Siswa</label>
    <input type="text" name="nama" class="form-control bg-light" 
           value="<?= session()->get('nama'); ?>" readonly>
</div>

        <div class="mb-3">
            <label>Jenis Izin</label>
            <select name="jenis_izin" class="form-control">
                <option value="Keluar">Keluar Lingkungan</option>
                <option value="Sakit">Sakit / Tidak Mengikuti Pelajaran</option>
                <option value="Pulang Awal">Izin Tiba-tiba Pulang</option>
            </select>
        </div>
        <div class="row mb-3">
<div class="row">
    <div class="col-md-6 mb-3">
        <label>Izin Jam Ke</label>
        <input type="number" name="jam_mulai" id="jam_mulai" class="form-control" min="1" max="10" placeholder="Contoh: 3" required>
    </div>
    
    <div class="col-md-6 mb-3">
        <label>Sampai Jam Ke</label>
        <input type="number" name="jam_selesai" id="jam_selesai" class="form-control" min="1" max="12" placeholder="Contoh: 5" required>
    </div>
</div>
</div>

        <div class="mb-3">
            <label>Alasan / Keterangan</label>
            <textarea name="alasan" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Izin</button>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </form>
</div>
<script>
    const jamMulai = document.getElementById('jam_mulai');
    const jamSelesai = document.getElementById('jam_selesai');

    // Ketika 'Izin Jam Ke' diisi/diubah...
    jamMulai.addEventListener('input', function() {
        // Otomatis batas minimal 'Sampai Jam Ke' mengikuti 'Izin Jam Ke'
        // Jadi kalau izin jam ke-4, nggak bisa pilih sampai jam ke-2
        jamSelesai.min = this.value; 
        
        // Kalau jam selesai yang udah terlanjur diisi lebih kecil, reset aja
        if(parseInt(jamSelesai.value) < parseInt(this.value)) {
            jamSelesai.value = this.value;
        }
    });
</script>