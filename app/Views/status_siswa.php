<?= $this->extend('layout_main') ?> <?= $this->section('content') ?>
<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold text-primary">Riwayat & Status Izin Saya</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu (Jam Ke)</th>
                        <th>Alasan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Surat (PDF)</th>
                    </tr>
                </thead>
<tbody>
                    <?php foreach ($izin as $row) : ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($row['created_at'] ?? 'now')) ?></td>
                        
                        <td>Jam <?= $row['jam_mulai'] ?> - <?= $row['jam_selesai'] ?></td>
                        
                        <td><?= $row['alasan'] ?></td>
                        
                        <td class="text-center">
                            <?php if ($row['status'] == 'Proses' || $row['status'] == 'Menunggu Guru'): ?>
                                <span class="badge rounded-pill bg-warning text-dark">Menunggu</span>
                            <?php else: ?>
                                <span class="badge rounded-pill <?= ($row['status'] == 'Disetujui') ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $row['status'] ?>
                                </span>
                                <br>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    Oleh: <b><?= !empty($row['nama_guru']) ? $row['nama_guru'] : '-' ?></b>
                                </small>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <?php if ($row['status'] == 'Disetujui'): ?>
                                <a href="<?= base_url('izin/cetak/' . $row['id']) ?>" class="btn btn-sm btn-primary shadow-sm" target="_blank">
                                    <i class="fas fa-file-pdf"></i> Cetak Surat
                                </a>
                            <?php elseif ($row['status'] == 'Ditolak'): ?>
                                <span class="text-danger"><i class="fas fa-ban"></i> Batal</span>
                            <?php else: ?>
                                <span class="text-muted fst-italic">Menunggu...</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>