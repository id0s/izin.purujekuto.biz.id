<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guru - Sistem Izin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="w-100" style="max-width: 400px; padding: 15px;">
        
        <div class="card shadow">
            <div class="card-body">
                
                <h4 class="text-center mb-4">Login</h4>
                
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('auth/proses_login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="id_login" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>

            </div>
        </div>
        
    </div>

</body>
</html>