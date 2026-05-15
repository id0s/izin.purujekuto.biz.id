<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Monitor Perizinan Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .badge-proses { background-color: #ffc107; color: #000; }
        .badge-setuju { background-color: #198754; color: #fff; }
        .badge-tolak { background-color: #dc3545; color: #fff; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Panel Monitor Perizinan</h2>
        <a href="<?= base_url('izin/logout') ?>" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('pesan') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Waktu</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Izin</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Aksi Guru</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($izin)) : ?>
                        <?php foreach ($izin as $row) : ?>
                        <tr>
                            <td><?= date('d/m H:i', strtotime($row['created_at'])) ?></td>
                            <td><?= $row['nisn'] ?></td>
                            <td><strong><?= $row['nama'] ?></strong></td>
                            <td><?= $row['jenis_izin'] ?></td>
                            <td><small><?= $row['alasan'] ?></small></td>
                            <td>
                                <?php 
                                    $class = 'badge-proses';
                                    if($row['status'] == 'Disetujui') $class = 'badge-setuju';
                                    if($row['status'] == 'Ditolak') $class = 'badge-tolak';
                                ?>
                                <span class="badge <?= $class ?>"><?= $row['status'] ?></span>
                            </td>
                            <td>
                                <?php if ($row['status'] == 'Proses') : ?>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('izin/update_status/'.$row['id'].'/Disetujui') ?>" 
                                           class="btn btn-sm btn-success">Setujui</a>
                                        <a href="<?= base_url('izin/update_status/'.$row['id'].'/Ditolak') ?>" 
                                           class="btn btn-sm btn-danger">Tolak</a>
                                    </div>
                                <?php else : ?>
                                    <span class="text-muted italic">Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data izin masuk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>