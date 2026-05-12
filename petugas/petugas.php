<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../login.php");
    exit;
}

$nama      = $_SESSION['nama'];
$idPetugas = $_SESSION['kode_petugas'] ?? 'PTG-001';
$wilayah   = $_SESSION['wilayah'] ?? 'Bandar Lampung';

$totalAktif    = 3;
$totalSelesai  = 18;
$rating        = 4.8;
$deadlineLewat = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - SAPA Lampung</title>
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/petugas.css">
</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <div class="sidebar-logo">P</div>
                <div>
                    <div class="sidebar-brand-name">SAPA Petugas</div>
                    <div class="sidebar-brand-sub">Panel Petugas Lapangan</div>
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="sidebar-item active">Dashboard</a>
                <a href="daftar-tugas.php" class="sidebar-item">Daftar Tugas</a>
                <a href="update-status.php" class="sidebar-item">Update Status</a>
                <a href="riwayat.php" class="sidebar-item">Riwayat Tugas</a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar"><?= strtoupper(substr($nama, 0, 1)); ?></div>
                <div>
                    <div class="sidebar-user-name"><?= htmlspecialchars($nama); ?></div>
                    <div class="sidebar-user-role"><?= htmlspecialchars($idPetugas); ?></div>
                </div>
            </div>
            <a href="#" class="sidebar-logout" onclick="confirmLogout()">Keluar</a>
        </div>
    </aside>

    <main class="main-content">

        <div class="petugas-hero">
            <div>
                <h1 class="page-title">Selamat Datang, <?= htmlspecialchars($nama); ?> 👋</h1>
                <p class="page-subtitle">Wilayah Tugas: <?= htmlspecialchars($wilayah); ?></p>
            </div>
            <div class="hero-status">⭐ Rating <?= $rating; ?>/5</div>
        </div>

        <div class="content-body">

            <div class="stats-row">
                <div class="stat-box stat-orange">
                    <div class="stat-box-label">Tugas Aktif</div>
                    <div class="stat-box-num"><?= $totalAktif; ?></div>
                    <div class="stat-box-change">Sedang berjalan</div>
                </div>
                <div class="stat-box stat-green">
                    <div class="stat-box-label">Tugas Selesai</div>
                    <div class="stat-box-num"><?= $totalSelesai; ?></div>
                    <div class="stat-box-change up">▲ Bulan ini</div>
                </div>
                <div class="stat-box stat-yellow">
                    <div class="stat-box-label">Rating</div>
                    <div class="stat-box-num"><?= $rating; ?></div>
                    <div class="stat-box-change">Penilaian masyarakat</div>
                </div>
                <div class="stat-box stat-red">
                    <div class="stat-box-label">Deadline Lewat</div>
                    <div class="stat-box-num"><?= $deadlineLewat; ?></div>
                    <div class="stat-box-change">Tugas terlambat</div>
                </div>
            </div>

            <div class="grid-2">

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Tugas Aktif</div>
                            <div class="card-subtitle">Daftar tugas yang sedang berjalan</div>
                        </div>
                        <a href="daftar-tugas.php" class="btn btn-outline btn-sm">Lihat Semua →</a>
                    </div>
                    <div class="tugas-list">

                        <div class="tugas-item urgent">
                            <div class="tugas-top">
                                <div>
                                    <div class="tugas-title">Jembatan Retak Membahayakan</div>
                                    <div class="tugas-id">RPT-2024-0855</div>
                                </div>
                                <span class="pill pill-pending">Baru</span>
                            </div>
                            <div class="tugas-lokasi">📍 Kedamaian, Bandar Lampung</div>
                            <div class="tugas-footer">
                                <span class="cat-tag cat-infrastruktur">🏗️ Infrastruktur</span>
                                <a href="update-status.php" class="action-btn">Update</a>
                            </div>
                        </div>

                        <div class="tugas-item warning">
                            <div class="tugas-top">
                                <div>
                                    <div class="tugas-title">Jalan Berlubang</div>
                                    <div class="tugas-id">RPT-2024-0842</div>
                                </div>
                                <span class="pill pill-diproses">Diproses</span>
                            </div>
                            <div class="tugas-lokasi">📍 Tanjung Karang</div>
                            <div class="tugas-footer">
                                <span class="cat-tag cat-infrastruktur">🏗️ Infrastruktur</span>
                                <a href="update-status.php" class="action-btn">Update</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div>
                            <div class="card-title">Notifikasi</div>
                            <div class="card-subtitle">Informasi terbaru</div>
                        </div>
                    </div>
                    <div class="notif-list">
                        <div class="notif-item">
                            <div class="notif-icon yellow">🔔</div>
                            <div>
                                <div class="notif-title">Tugas Baru Masuk</div>
                                <div class="notif-desc">Anda mendapat tugas baru RPT-2024-0855</div>
                            </div>
                        </div>
                        <div class="notif-item">
                            <div class="notif-icon blue">⏰</div>
                            <div>
                                <div class="notif-title">Reminder Deadline</div>
                                <div class="notif-desc">Deadline tugas besok pukul 16.00</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

</div>

<script>
function confirmLogout() {
    const yakin = confirm("Yakin ingin keluar?");
    if (yakin) window.location.href = "../logout.php";
}
</script>

</body>
</html>