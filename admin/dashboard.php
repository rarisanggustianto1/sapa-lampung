<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
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

    <title>Dashboard Admin - SAPA Lampung</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">

        <div>

            <div class="sidebar-brand">

                <div class="sidebar-logo">
                    A
                </div>

                <div>
                    <div class="sidebar-brand-name">
                        SAPA Admin
                    </div>

                    <div class="sidebar-brand-sub">
                        Panel Administrator
                    </div>
                </div>

            </div>

            <nav class="sidebar-nav">

                <a href="dashboard.php" class="sidebar-item active">
                    Dashboard
                </a>

                <a href="laporan.php" class="sidebar-item">
                    Laporan Masuk
                </a>

                <a href="tracking.php" class="sidebar-item">
                    Tracking
                </a>

                <a href="statistik.php" class="sidebar-item">
                    Statistik
                </a>

                <a href="petugas.php" class="sidebar-item">
                    Manajemen Petugas
                </a>

                <a href="akun.php" class="sidebar-item">
                    Kelola Akun
                </a>

            </nav>

        </div>

        <div class="sidebar-footer">

            <div class="sidebar-user">

                <div class="sidebar-avatar">
                    <?= strtoupper(substr($nama, 0, 1)); ?>
                </div>

                <div>
                    <div class="sidebar-user-name">
                        <?= htmlspecialchars($nama); ?>
                    </div>

                    <div class="sidebar-user-role">
                        Administrator
                    </div>
                </div>

            </div>

            <a href="#" class="sidebar-logout" onclick="confirmLogout()">
                Keluar
            </a>

        </div>

    </aside>

    <main class="main-content">

        <div class="topbar">

            <div>

                <h1 class="page-title">
                    Dashboard Admin
                </h1>

                <p class="page-subtitle">
                    Selamat datang kembali, <?= htmlspecialchars($nama); ?>
                </p>

            </div>

        </div>

        <div class="content-body">

            <div class="stats-row">

                <div class="stat-box">
                    <div class="stat-box-label">
                        Total Laporan
                    </div>

                    <div class="stat-box-num">
                        4.821
                    </div>

                    <div class="stat-box-change up">
                        +127 bulan ini
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">
                        Sedang Diproses
                    </div>

                    <div class="stat-box-num">
                        342
                    </div>

                    <div class="stat-box-change">
                        +12 hari ini
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">
                        Laporan Selesai
                    </div>

                    <div class="stat-box-num">
                        4.102
                    </div>

                    <div class="stat-box-change up">
                        85,1% resolved
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">
                        Laporan Pending
                    </div>

                    <div class="stat-box-num">
                        377
                    </div>

                    <div class="stat-box-change down">
                        -8 dari kemarin
                    </div>
                </div>

            </div>

            <div class="grid-2">

                <div class="card">

                    <div class="card-header">

                        <div>

                            <div class="card-title">
                                Laporan Terbaru
                            </div>

                            <div class="card-subtitle">
                                Perlu tindakan segera
                            </div>

                        </div>

                        <a href="laporan.php" class="btn btn-outline">
                            Lihat Semua
                        </a>

                    </div>

                    <div class="table-wrap">

                        <table>

                            <thead>
                                <tr>
                                    <th>ID Laporan</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>
                                        <span class="id-badge">
                                            RPT-0856
                                        </span>
                                    </td>

                                    <td>
                                        <span class="cat-tag cat-kebersihan">
                                            Kebersihan
                                        </span>
                                    </td>

                                    <td>
                                        <span class="pill pill-pending">
                                            Pending
                                        </span>
                                    </td>

                                    <td>
                                        <a href="#" class="action-btn">
                                            Detail
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="id-badge">
                                            RPT-0855
                                        </span>
                                    </td>

                                    <td>
                                        <span class="cat-tag cat-infrastruktur">
                                            Infrastruktur
                                        </span>
                                    </td>

                                    <td>
                                        <span class="pill pill-verifikasi">
                                            Verifikasi
                                        </span>
                                    </td>

                                    <td>
                                        <a href="#" class="action-btn">
                                            Detail
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span class="id-badge">
                                            RPT-0842
                                        </span>
                                    </td>

                                    <td>
                                        <span class="cat-tag cat-keamanan">
                                            Keamanan
                                        </span>
                                    </td>

                                    <td>
                                        <span class="pill pill-diproses">
                                            Diproses
                                        </span>
                                    </td>

                                    <td>
                                        <a href="#" class="action-btn">
                                            Detail
                                        </a>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <div>

                            <div class="card-title">
                                Petugas Aktif
                            </div>

                            <div class="card-subtitle">
                                Status tugas saat ini
                            </div>

                        </div>

                        <a href="petugas.php" class="btn btn-outline">
                            Kelola
                        </a>

                    </div>

                    <div class="petugas-list">

                        <div class="petugas-item">

                            <div class="petugas-left">

                                <div class="mini-avatar green">
                                    AF
                                </div>

                                <div>
                                    <div class="petugas-name">
                                        Ahmad Fauzi
                                    </div>

                                    <div class="petugas-role">
                                        Infrastruktur
                                    </div>
                                </div>

                            </div>

                            <span class="pill pill-diproses">
                                3 Tugas
                            </span>

                        </div>

                        <div class="petugas-item">

                            <div class="petugas-left">

                                <div class="mini-avatar amber">
                                    SR
                                </div>

                                <div>
                                    <div class="petugas-name">
                                        Siti Rahayu
                                    </div>

                                    <div class="petugas-role">
                                        Kebersihan
                                    </div>
                                </div>

                            </div>

                            <span class="pill pill-verifikasi">
                                2 Tugas
                            </span>

                        </div>

                        <div class="petugas-item">

                            <div class="petugas-left">

                                <div class="mini-avatar blue">
                                    BW
                                </div>

                                <div>
                                    <div class="petugas-name">
                                        Bambang Wijaya
                                    </div>

                                    <div class="petugas-role">
                                        Keamanan
                                    </div>
                                </div>

                            </div>

                            <span class="pill pill-selesai">
                                1 Tugas
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

<script>

function confirmLogout() {

    const yakin = confirm("Yakin mau keluar dari akun?");

    if ( yakin ) {
        window.location.href = "../logout.php";
    }

}

</script>

</body>
</html>