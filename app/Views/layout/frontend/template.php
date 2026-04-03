<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Informasi Sekolah' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/custom/css/frontend.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/custom/css/kelulusan.css') ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8faff;
            padding-top: 70px;
        }
        @keyframes gradientAnim {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .bg-gradient-animated {
            background: linear-gradient(-45deg, #4e54c8, #8f94fb, #11998e, #38ef7d);
            background-size: 400% 400%;
            animation: gradientAnim 15s ease infinite;
        }
        .footer-modern {
            background: linear-gradient(135deg, #1e1e2f 0%, #2a2a40 100%);
        }
        .glass-card-dark {
            background: rgba(30, 30, 47, 0.7) !important;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
    </style>
</head>
<body>
    <?= $this->include('layout/frontend/header') ?>
    
    <main class="min-vh-100">
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('layout/frontend/footer') ?>
</body>
</html>