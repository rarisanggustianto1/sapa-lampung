<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'masyarakat') {
    header("Location: ../login.php");
    exit;
}

$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - SAPA Lampung</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/masyarakat.css">
</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">

        <div class="sidebar-brand">
            <div class="sidebar-logo">S</div>
            <div>
                <div class="sidebar-brand-name">SAPA</div>
                <div class="sidebar-brand-sub">Portal Masyarakat</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="dashboard.php" class="sidebar-item">Dashboard</a>
            <a href="lapor.php" class="sidebar-item active">Buat Laporan</a>
            <a href="tracking.php" class="sidebar-item">Tracking Laporan</a>
            <a href="riwayat.php" class="sidebar-item">Riwayat Laporan</a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    <?= strtoupper(substr($nama,0,1)); ?>
                </div>
                <div>
                    <div class="sidebar-user-name"><?= $nama; ?></div>
                    <div class="sidebar-user-role">Masyarakat</div>
                </div>
            </div>
            <a href="#" class="sidebar-logout" onclick="confirmLogout()">Keluar</a>
        </div>

    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1 class="page-title">Buat Laporan</h1>
                <p class="page-subtitle">Laporkan masalah masyarakat dengan lengkap</p>
            </div>
        </div>

        <div class="content-body">

            <div class="form-card">

                <div class="form-header">
                    <h2>Form Laporan Masyarakat</h2>
                    <p>Isi data laporan dengan benar agar mudah diproses petugas.</p>
                </div>

                <form>

                    <div class="form-group">
                        <label>Judul Laporan</label>
                        <input type="text" class="form-input" placeholder="Contoh: Jalan berlubang besar">
                    </div>

                    <div class="form-group">
                        <label>Kategori Laporan</label>
                        <select class="form-input">
                            <option>Infrastruktur</option>
                            <option>Kebersihan</option>
                            <option>Fasilitas Umum</option>
                            <option>Keamanan</option>
                            <option>Darurat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Masalah</label>
                        <textarea class="form-textarea" placeholder="Jelaskan detail masalah..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Alamat Kejadian</label>
                        <input type="text" class="form-input" placeholder="Masukkan alamat lengkap">
                    </div>

                    <div class="form-group">
                        <label>Upload Foto</label>
                        <div class="upload-box">
                            <div class="upload-icon">📷</div>
                            <p>Klik untuk upload foto</p>
                            <span>JPG / PNG maksimal 5MB</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tingkat Urgensi</label>
                        <div class="urgensi-group">
                            <label class="urgensi-item">
                                <input type="radio" name="urgensi">
                                Rendah
                            </label>
                            <label class="urgensi-item">
                                <input type="radio" name="urgensi" checked>
                                Sedang
                            </label>
                            <label class="urgensi-item">
                                <input type="radio" name="urgensi">
                                Tinggi
                            </label>
                        </div>
                    </div>

                    <div class="form-action">
                        <a href="dashboard.php" class="btn-secondary">Batal</a>
                        <button type="submit" class="btn-primary">Kirim Laporan</button>
                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<script>
function confirmLogout() {
    const yakin = confirm("Yakin mau keluar dari akun?");
    if (yakin) {
        window.location.href = "../logout.php";
    }
}
</script>

</body>
</html>