<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Akses | Sistem Informasi Sekolah</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            position: relative;
            overflow: hidden;
        }

        /* Animated Gradient Background */
        .bg-animated {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(45deg, #1e1b4b, #312e81, #4c1d95, #0f172a);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            z-index: 0;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 1;
            opacity: 0.6;
            animation: floatOrb 10s infinite ease-in-out alternate;
        }
        .orb-1 { width: 300px; height: 300px; background: #818cf8; top: -50px; left: -50px; animation-delay: 0s; }
        .orb-2 { width: 400px; height: 400px; background: #c084fc; bottom: -100px; right: -50px; animation-delay: -5s; }
        .orb-3 { width: 200px; height: 200px; background: #38bdf8; top: 40%; left: 60%; animation-delay: -2s; }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 50px) scale(1.1); }
        }

        /* Glassmorphism Card */
        .login-glass {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 50px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-icon-top {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
            transform: rotate(-10deg);
        }
        
        .login-icon-top i {
            font-size: 2.5rem;
            color: #fff;
            transform: rotate(10deg);
        }

        /* Modern Input Fields */
        .input-group-custom {
            position: relative;
            margin-bottom: 25px;
        }
        .input-group-custom i {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.2rem;
            transition: color 0.3s;
            z-index: 5;
        }
        .input-modern {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 16px 20px 16px 55px;
            color: #fff;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .input-modern::placeholder {
            color: #64748b;
        }
        .input-modern:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #818cf8;
            box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.15);
            outline: none;
        }
        .input-modern:focus + i, .input-group-custom:focus-within i {
            color: #818cf8;
        }

        /* Gradient Button */
        .btn-login {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: #fff;
            border: none;
            border-radius: 16px;
            padding: 16px;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            width: 100%;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.5);
            color: #fff;
        }
        
        .alert-glass {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 0.9rem;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
        }

        .back-link {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.3s;
        }
        .back-link:hover {
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="bg-animated"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="login-glass">
        <div class="login-icon-top">
            <i class="fas fa-fingerprint"></i>
        </div>
        
        <div class="text-center mb-5">
            <h3 class="text-white fw-bolder tracking-tight mb-2">Sistem Informasi Sekolah</h3>
            <p class="text-secondary fw-medium fs-6 m-0" style="color: #94a3b8 !important;">Silakan masuk menggunakan akun Anda</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-glass text-center fw-semibold">
                <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login/proses') ?>" method="post">
            <div class="input-group-custom">
                <input type="text" name="username" class="input-modern" placeholder="Username Anda" required autocomplete="off">
                <i class="fas fa-user-circle"></i>
            </div>
            
            <div class="input-group-custom mb-5">
                <input type="password" name="password" class="input-modern" placeholder="Kata Sandi Akses" required>
                <i class="fas fa-lock"></i>
            </div>
            
            <button type="submit" class="btn btn-login">
                AUTENTIKASI MASUK <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="text-center mt-5">
            <a href="<?= base_url('/') ?>" class="back-link">
                <i class="fas fa-home me-2"></i> Kembali ke Portal Utama
            </a>
        </div>
    </div>

</body>
</html>