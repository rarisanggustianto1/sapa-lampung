<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    } elseif ($_SESSION['role'] == 'petugas') {
        header("Location: petugas/petugas.php");
        exit;
    }
}

include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='aktif'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == 'admin') {
            header("Location: admin/dashboard.php");
            exit;
        } elseif ($data['role'] == 'petugas') {
            $query_ptg = mysqli_query($conn, "SELECT * FROM petugas WHERE id_user='" . $data['id_user'] . "'");
            $data_ptg = mysqli_fetch_assoc($query_ptg);
            
            if ($data_ptg) {
                $_SESSION['id_petugas'] = $data_ptg['id_petugas'];
                $_SESSION['kode_petugas'] = $data_ptg['kode_petugas'];
                $_SESSION['divisi'] = $data_ptg['divisi'];
                $_SESSION['wilayah'] = $data_ptg['wilayah'];
                $_SESSION['rating'] = $data_ptg['rating'];
            }
            header("Location: petugas/petugas.php");
            exit;
        }
    } else {
        $error = "Email atau password salah, atau akun dinonaktifkan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SAPA Lampung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        .admin-contact-box {
            margin-top: 24px;
            padding: 14px;
            background-color: #f8fafc;
            border: 1px dashed #e2e8f0;
            border-radius: 12px;
            text-align: center;
        }
        .admin-contact-box p {
            font-size: 12px;
            color: #6b7280;
            margin: 0 0 6px 0;
            line-height: 1.4;
        }
        .admin-contact-box a {
            font-size: 13px;
            color: #c62828;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .admin-contact-box a:hover {
            color: #8e1c1c;
        }
    </style>
</head>

<body>
    <div class="login-page">

        <div class="login-left">
            <div class="overlay"></div>
            <img src="assets/img/login/kantor-lampung.jpg" alt="Gedung Pemerintah Lampung">
            <div class="login-left-content">
                <div class="login-logo">S</div>
                <h2>SAPA Lampung</h2>
                <p>Sistem Aspirasi dan Pelaporan Masyarakat Provinsi Lampung</p>
            </div>
        </div>

        <div class="login-right">
            <div class="login-form-wrapper">
                <a href="index.php" class="back-link">← Kembali ke Beranda</a>
                <span class="login-badge">Portal Login</span>
                <h1>Masuk ke Sistem</h1>
                <p class="login-desc">Silakan masuk menggunakan akun yang telah terdaftar.</p>

                <?php if (isset($error)) : ?>
                    <div class="alert-error">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Masukkan email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-red btn-login">Masuk</button>
                </form>

                <div class="admin-contact-box">
                    <p>Khusus Petugas: Lupa username atau password akun Anda?</p>
                    <a href="https://wa.me/6281234567890" target="_blank">💬 Hubungi Admin via WhatsApp</a>
                </div>

                <div class="login-footer">
                    <p>Belum punya akun petugas? Hubungi admin sistem.</p>
                </div>
            </div>
        </div>

    </div>
</body>
</html>