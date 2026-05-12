<?php
session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];



    // =========================
    // LOGIN MASYARAKAT
    // =========================
    if($email == "user@gmail.com" && $password == "user123"){

        $_SESSION['login'] = true;
        $_SESSION['nama'] = "Budi Santoso";
        $_SESSION['role'] = "masyarakat";

        header("Location: masyarakat/dashboard.php");
        exit;
    }



    // =========================
    // LOGIN ADMIN
    // =========================
    elseif($email == "admin@gmail.com" && $password == "admin123"){

        $_SESSION['login'] = true;
        $_SESSION['nama'] = "Administrator";
        $_SESSION['role'] = "admin";

        header("Location: admin/dashboard.php");
        exit;
    }



    // =========================
    // LOGIN PETUGAS
    // =========================
    elseif($email == "petugas@gmail.com" && $password == "petugas123"){

        $_SESSION['login'] = true;
        $_SESSION['nama'] = "Ahmad Fauzi";
        $_SESSION['role'] = "petugas";

        header("Location: petugas/petugas.php");
        exit;
    }



    // =========================
    // LOGIN GAGAL
    // =========================
    else{

        $error = "Email atau password salah!";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Login — SAPA Lampung
    </title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/global.css">

    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

    <div class="login-page">



        <!-- ================= LEFT PANEL ================= -->

        <div class="login-left">

            <div class="overlay"></div>

            <img
                src="assets/img/login/kantor-lampung.jpg"
                alt="Gedung Pemerintah Lampung"
            >

            <div class="login-left-content">

                <div class="login-logo">
                    S
                </div>

                <h2>
                    SAPA Lampung
                </h2>

                <p>
                    Sistem Aspirasi dan Pelaporan
                    Masyarakat Provinsi Lampung
                </p>

            </div>

        </div>



        <!-- ================= RIGHT PANEL ================= -->

        <div class="login-right">

            <div class="login-form-wrapper">

                <a href="index.php" class="back-link">
                    ← Kembali ke Beranda
                </a>

                <span class="login-badge">
                    Portal Login
                </span>

                <h1>
                    Masuk ke Sistem
                </h1>

                <p class="login-desc">
                    Silakan masuk menggunakan akun
                    yang telah terdaftar.
                </p>



                <!-- ALERT ERROR -->
                <?php if(isset($error)) : ?>

                    <div class="alert-error">
                        <?php echo $error; ?>
                    </div>

                <?php endif; ?>



                <!-- FORM LOGIN -->
                <form method="POST">

                    <div class="form-group">

                        <label>
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="Masukkan email"
                            required
                        >

                    </div>



                    <div class="form-group">

                        <label>
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >

                    </div>



                    <button
                        type="submit"
                        name="login"
                        class="btn btn-red btn-login"
                    >
                        Masuk
                    </button>

                </form>



                <div class="login-footer">

                    <p>
                        Belum punya akun?
                        Hubungi admin sistem.
                    </p>

                </div>

            </div>

        </div>

    </div>

</body>
</html>