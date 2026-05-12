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
    <title>Riwayat Laporan — SAPA Lampung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/masyarakat.css">
    <link rel="stylesheet" href="../assets/css/riwayat.css">
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
                <a href="dashboard.php" class="sidebar-item">&ensp;Dashboard</a>
                <a href="buat-laporan.php" class="sidebar-item">&ensp;Buat Laporan</a>
                <a href="tracking.php" class="sidebar-item">&ensp;Tracking Laporan</a>
                <a href="riwayat.php" class="sidebar-item active">&ensp;Riwayat Laporan</a>
            </nav>
        </div>
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar"><?= strtoupper(substr($nama,0,1)) ?></div>
                <div>
                    <div class="sidebar-user-name"><?= htmlspecialchars($nama) ?></div>
                    <div class="sidebar-user-role">Masyarakat</div>
                </div>
            </div>
            <a href="#" class="sidebar-logout" onclick="confirmLogout()">Keluar</a>
        </div>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1 class="page-title">Riwayat Laporan</h1>
                <p class="page-subtitle">Seluruh laporan yang pernah Anda buat</p>
            </div>
        </div>

        <div class="content-body">
            <div class="riwayat-card">

                <div class="riwayat-header">
                    <div>
                        <h3 class="riwayat-header-title">Semua Laporan</h3>
                        <p class="riwayat-header-sub">8 laporan terdaftar</p>
                    </div>
                    <a href="buat-laporan.php" class="btn-primary-red">＋&ensp;Buat Laporan</a>
                </div>

                <div class="filter-row">
                    <div class="filter-search-wrap">
                        <input type="text" class="filter-input" placeholder="Cari laporan berdasarkan judul atau ID...">
                    </div>
                    <select class="filter-select">
                        <option>Semua Kategori</option>
                        <option>Infrastruktur</option>
                        <option>Kebersihan</option>
                        <option>Darurat</option>
                        <option>Sosial</option>
                    </select>
                    <select class="filter-select">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Diproses</option>
                        <option>Verifikasi</option>
                        <option>Selesai</option>
                    </select>
                </div>

                <div class="table-wrapper">
                    <table class="riwayat-table">
                        <thead>
                            <tr>
                                <th>ID Laporan</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-id">RPT-2024-0842</td>
                                <td class="col-judul">Jalan Berlubang di Palapa</td>
                                <td><span class="kategori-badge infrastruktur">Infrastruktur</span></td>
                                <td class="col-tanggal">12 Nov 2024</td>
                                <td><span class="status-pill proses">Diproses</span></td>
                                <td><a href="tracking.php?id=RPT-2024-0842" class="detail-btn">Detail →</a></td>
                            </tr>
                            <tr>
                                <td class="col-id">RPT-2024-0856</td>
                                <td class="col-judul">Tumpukan Sampah TPS</td>
                                <td><span class="kategori-badge kebersihan">Kebersihan</span></td>
                                <td class="col-tanggal">13 Nov 2024</td>
                                <td><span class="status-pill pending">Pending</span></td>
                                <td><a href="tracking.php?id=RPT-2024-0856" class="detail-btn">Detail →</a></td>
                            </tr>
                            <tr>
                                <td class="col-id">RPT-2024-0790</td>
                                <td class="col-judul">Pohon Tumbang di Jl. Teuku Umar</td>
                                <td><span class="kategori-badge darurat">Darurat</span></td>
                                <td class="col-tanggal">28 Okt 2024</td>
                                <td><span class="status-pill selesai">Selesai</span></td>
                                <td><a href="tracking.php?id=RPT-2024-0790" class="detail-btn">Detail →</a></td>
                            </tr>
                            <tr>
                                <td class="col-id">RPT-2024-0755</td>
                                <td class="col-judul">Lampu PJU Padam</td>
                                <td><span class="kategori-badge infrastruktur">Infrastruktur</span></td>
                                <td class="col-tanggal">20 Okt 2024</td>
                                <td><span class="status-pill selesai">Selesai</span></td>
                                <td><a href="tracking.php?id=RPT-2024-0755" class="detail-btn">Detail →</a></td>
                            </tr>
                            <tr>
                                <td class="col-id">RPT-2024-0731</td>
                                <td class="col-judul">Got Tersumbat Jl. Wahidin</td>
                                <td><span class="kategori-badge kebersihan">Kebersihan</span></td>
                                <td class="col-tanggal">15 Okt 2024</td>
                                <td><span class="status-pill selesai">Selesai</span></td>
                                <td><a href="tracking.php?id=RPT-2024-0731" class="detail-btn">Detail →</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button class="page-btn arrow">‹</button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn arrow">›</button>
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