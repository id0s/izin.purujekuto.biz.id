<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Izin Purujekuto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            
<a href="<?= base_url('izin') ?>" class="text-white text-decoration-none d-flex align-items-center">
    <img src="https://cdn-icons-png.flaticon.com/512/2942/2942503.png" width="30" class="me-2" alt="Logo">
    <span class="fw-bold fs-4">
        <?php if (session()->get('role') == 'guru') : ?>
            <i class="fas fa-school"></i> E-Izin Guru
        <?php elseif (session()->get('role') == 'siswa') : ?>
            <i class="fas fa-user-graduate"></i> E-Izin Siswa
        <?php else : ?>
            E-Izin Sekolah
        <?php endif; ?>
    </span>
</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active d-flex align-items-center" href="#" id="userDrop" role="button" data-bs-toggle="dropdown">
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="25" class="rounded-circle me-2">
                            <?= session()->get('nama') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="#">Profile Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>