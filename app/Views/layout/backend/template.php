<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashboard | SIS' ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/custom/css/admin_custom.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f7f6;
        }
        .wrapper {
            background-color: #f4f7f6;
        }
        @keyframes gradientAnim {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .bg-gradient-animated {
            background: linear-gradient(-45deg, #FF416C, #FF4B2B, #11998e, #38ef7d);
            background-size: 400% 400%;
            animation: gradientAnim 15s ease infinite;
        }
        .sidebar-modern {
            background: linear-gradient(180deg, #1e1e2f 0%, #2a2a40 100%) !important;
            border-right: none !important;
        }
        .nav-modern {
            border-radius: 12px;
            margin: 4px 12px;
            transition: all 0.3s ease;
        }
        .nav-modern:hover, .nav-pills .nav-link.active {
            background: rgba(255,255,255,0.1) !important;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            backdrop-filter: blur(5px);
        }
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            background: #ffffff;
            margin-bottom: 24px;
        }
        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.03);
            padding: 20px 24px;
        }
        .card-body {
            padding: 24px;
        }
        .modern-header {
            border-radius: 0 0 16px 16px;
            margin: 0;
            background: #ffffff !important;
        }
        .btn-icon-hover {
            color: #6c757d;
            transition: 0.3s;
        }
        .btn-icon-hover:hover {
            background: #f8f9fa;
            color: #007bff;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.1);
            border-color: #a0aec0;
        }
        .btn {
            border-radius: 10px;
            padding: 8px 20px;
        }
        .content-wrapper {
            background-color: transparent !important;
            padding: 20px 15px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
<div class="wrapper">

    <?= $this->include('layout/backend/header') ?>
    <?= $this->include('layout/backend/sidebar') ?>

    <div class="content-wrapper">
        <section class="content-header px-3">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="fw-bold text-dark m-0 fs-3"><?= $title ?? 'Dashboard' ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content px-3">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

    <?= $this->include('layout/backend/footer') ?>

</div>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="<?= base_url('assets/custom/js/admin_custom.js') ?>"></script>
</body>
</html>