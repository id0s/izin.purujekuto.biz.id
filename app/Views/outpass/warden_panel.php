<!-- Menggunakan Bootstrap 5 -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Student</th>
            <th>Reason</th>
            <th>Out Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($requests as $r): ?>
        <tr>
            <td><?= $r['student_name'] ?></td>
            <td><?= $r['reason'] ?></td>
            <td><?= $r['out_date'] ?></td>
            <td><span class="badge bg-info"><?= $r['status'] ?></span></td>
            <td>
                <?php if($r['status'] == 'pending'): ?>
                    <a href="/outpass/updateStatus/<?= $r['id'] ?>/approved" class="btn btn-success btn-sm">Approve</a>
                    <a href="/outpass/updateStatus/<?= $r['id'] ?>/rejected" class="btn btn-danger btn-sm">Reject</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>