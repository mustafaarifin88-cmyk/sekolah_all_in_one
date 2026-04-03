<nav class="main-header navbar navbar-expand navbar-white navbar-light border-0 modern-header shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link rounded-circle btn-icon-hover" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('/') ?>" class="nav-link fw-semibold text-dark" target="_blank">Lihat Website</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('uploads/profil/' . (session()->get('foto') ?? 'default.png')) ?>" class="user-image img-circle shadow-sm bg-white p-1" alt="User Image">
                <span class="d-none d-md-inline fw-bold text-dark"><?= session()->get('username') ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded-4 shadow-lg border-0 mt-2">
                <li class="user-header bg-gradient-animated text-white rounded-top-4">
                    <img src="<?= base_url('uploads/profil/' . (session()->get('foto') ?? 'default.png')) ?>" class="img-circle shadow bg-white p-1" alt="User Image">
                    <p class="fw-bold mt-2">
                        <?= session()->get('username') ?>
                        <small class="text-light opacity-75 d-block mt-1 text-uppercase"><?= session()->get('role') ?></small>
                    </p>
                </li>
                <li class="user-footer rounded-bottom-4 bg-light d-flex justify-content-between p-3">
                    <a href="<?= base_url(session()->get('role') . '/profil') ?>" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold">Profil</a>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger rounded-pill px-4 shadow-sm fw-semibold">Keluar</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>