<?= $this->extend('layout_main') ?>

<?= $this->section('content') ?>
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold text-primary">Monitor Perizinan Siswa</h5>
    </div>
    <div class="card-body p-3"> <div class="table-responsive">
            <table id="tabelIzin" class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Waktu (Jam Ke)</th>
                        <th>Alasan</th>
                        <th class="text-center">Aksi / Status</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($izin as $row) : ?>
                    <tr>
                        <td>
                            <div class="fw-bold"><?= $row['nama'] ?></div>
                            <small class="text-muted"><?= $row['nis'] ?></small>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">
                                Jam <?= $row['jam_mulai'] ?> - <?= $row['jam_selesai'] ?>
                            </span>
                        </td>
                        <td><?= $row['alasan'] ?></td>
                        
                        <td class="text-center">
                            <?php if ($row['status'] == 'Proses' || $row['status'] == 'Menunggu Guru'): ?>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('izin/setujui/'.$row['id']) ?>" class="btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-check"></i> Setujui
                                    </a>
                                    <a href="<?= base_url('izin/tolak/'.$row['id']) ?>" class="btn btn-sm btn-danger shadow-sm">
                                        <i class="fas fa-times"></i> Tolak
                                    </a>
                                </div>
                            <?php else: ?>
                                <span class="text-<?= ($row['status'] == 'Disetujui') ? 'success' : 'danger' ?> fw-bold">
                                    <i class="fas <?= ($row['status'] == 'Disetujui') ? 'fa-check-circle' : 'fa-times-circle' ?>"></i> <?= $row['status'] ?>
                                </span>
                                <br>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    Oleh: <b><?= !empty($row['nama_guru']) ? $row['nama_guru'] : '-' ?></b>
                                </small>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelIzin').DataTable({
            "language": {
                "search": "Cari data:",
                "lengthMenu": "Tampilkan _MENU_ baris",
                "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data",
                "zeroRecords": "Data tidak ditemukan",
                "paginate": {
                    "next": "›",
                    "previous": "‹"
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>