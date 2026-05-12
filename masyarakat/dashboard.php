<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masyarakat — SAPA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/masyarakat.css">
</head>

<body>
<div class="dashboard-layout">

    <aside class="sidebar">
        <div>
            <div class="sidebar-brand">
                <div class="sidebar-logo">S</div>
                <div>
                    <div class="sidebar-brand-name">SAPA</div>
                    <div class="sidebar-brand-sub">Portal Masyarakat</div>
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="sidebar-item active">&ensp;Dashboard</a>
                <a href="buat-laporan.php" class="sidebar-item">&ensp;Buat Laporan</a>
                <a href="tracking.php" class="sidebar-item">&ensp;Tracking Laporan</a>
                <a href="riwayat.php" class="sidebar-item">&ensp;Riwayat Laporan</a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    <?php echo strtoupper(substr($_SESSION['nama'], 0, 1)); ?>
                </div>
                <div>
                    <div class="sidebar-user-name"><?php echo htmlspecialchars($_SESSION['nama']); ?></div>
                    <div class="sidebar-user-role">Masyarakat</div>
                </div>
            </div>
            <a href="#" class="sidebar-logout" onclick="confirmLogout()">Keluar</a>
        </div>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h2 class="page-title">Dashboard</h2>
                <p class="page-subtitle">
                    Selamat datang kembali, <strong><?php echo htmlspecialchars($_SESSION['nama']); ?></strong> 👋
                </p>
            </div>
            <div class="topbar-user">
                <div class="topbar-avatar">
                    <?php echo strtoupper(substr($_SESSION['nama'], 0, 1)); ?>
                </div>
            </div>
        </div>

        <div class="content-body">

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Laporan</div>
                    <div class="stat-number">8</div>
                    <div class="stat-info"><span class="up">+2</span> laporan bulan ini</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Sedang Diproses</div>
                    <div class="stat-number">3</div>
                    <div class="stat-info">2 diproses &bull; 1 pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Laporan Selesai</div>
                    <div class="stat-number">5</div>
                    <div class="stat-info">62% terselesaikan</div>
                </div>
            </div>

            <div class="alert-box">
                <strong>Update Laporan:</strong>
                Petugas sedang menuju lokasi laporan Anda.
            </div>

            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Laporan Aktif</h3>
                        <p class="card-subtitle">Daftar laporan yang sedang diproses</p>
                    </div>
                </div>

                <div class="laporan-item">
                    <div class="laporan-top">
                        <div>
                            <div class="laporan-title">Jalan Berlubang Parah</div>
                            <div class="laporan-id">RPT-2024-0842</div>
                        </div>
                        <span class="status diproses">Diproses</span>
                    </div>
                    <div class="laporan-lokasi">Bandar Lampung</div>
                    <div class="progress">
                        <div class="progress-bar w-75"></div>
                    </div>
                </div>

                <div class="laporan-item">
                    <div class="laporan-top">
                        <div>
                            <div class="laporan-title">Lampu Jalan Mati</div>
                            <div class="laporan-id">RPT-2024-0851</div>
                        </div>
                        <span class="status verifikasi">Verifikasi</span>
                    </div>
                    <div class="laporan-lokasi">Bandar Lampung</div>
                    <div class="progress">
                        <div class="progress-bar w-40"></div>
                    </div>
                </div>

                <div class="laporan-item">
                    <div class="laporan-top">
                        <div>
                            <div class="laporan-title">Tumpukan Sampah</div>
                            <div class="laporan-id">RPT-2024-0856</div>
                        </div>
                        <span class="status pending">Pending</span>
                    </div>
                    <div class="laporan-lokasi">Sukarame</div>
                    <div class="progress">
                        <div class="progress-bar w-10"></div>
                    </div>
                </div>

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