<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Surat Izin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow border-0 text-center">
                    <div class="card-body p-4">
                        
                        <?php if ($izin['status'] == 'Disetujui'): ?>
                            <i class="fas fa-check-circle text-success" style="font-size: 6rem;"></i>
                            <h2 class="mt-3 text-success fw-bold">SURAT VALID</h2>
                            <hr>
                            <h5 class="fw-bold"><?= $izin['nama'] ?></h5>
                            <p class="text-muted mb-3">NIS: <?= $izin['nis'] ?></p>
                            
                            <p class="mb-1">Telah diizinkan keluar pada:</p>
                            <p class="fw-bold badge bg-primary" style="font-size: 1rem;">Jam ke-<?= $izin['jam_mulai'] ?> s/d <?= $izin['jam_selesai'] ?></p>
                            
                            <p class="mt-4 mb-0 text-muted">Disetujui Oleh:</p>
                            <h5 class="fw-bold text-dark"><?= $izin['nama_guru'] ?></h5>
                        
                        <?php else: ?>
                            <i class="fas fa-times-circle text-danger" style="font-size: 6rem;"></i>
                            <h2 class="mt-3 text-danger fw-bold">TIDAK VALID / DITOLAK</h2>
                            <p class="mt-3">Status surat ini saat ini adalah: <b><?= $izin['status'] ?></b></p>
                            <p class="text-muted">Silakan hubungi guru piket/BK.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>