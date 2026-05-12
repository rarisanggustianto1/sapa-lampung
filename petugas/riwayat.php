<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../login.php");
    exit;
}

$nama         = $_SESSION['nama'];
$idPetugas    = $_SESSION['kode_petugas'] ?? 'PTG-001';
$wilayah      = $_SESSION['wilayah'] ?? 'Bandar Lampung';

$totalSelesai = 87;
$rating       = 4.8;
$rataWaktu    = "3.1 Jam";
$bulanIni     = 18;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tugas - SAPA Lampung</title>
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
                <a href="petugas.php" class="sidebar-item">Dashboard</a>
                <a href="daftar-tugas.php" class="sidebar-item">Daftar Tugas</a>
                <a href="update-status.php" class="sidebar-item">Update Status</a>
                <a href="riwayat.php" class="sidebar-item active">Riwayat Tugas</a>
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
                <h1 class="page-title">Riwayat Tugas Saya</h1>
                <p class="page-subtitle"><?= htmlspecialchars($nama); ?> • <?= htmlspecialchars($wilayah); ?></p>
            </div>
            <div class="hero-status">⭐ <?= $rating; ?>/5</div>
        </div>

        <div class="content-body">

            <div class="stats-row">
                <div class="stat-box stat-green">
                    <div class="stat-box-label">Total Selesai</div>
                    <div class="stat-box-num"><?= $totalSelesai; ?></div>
                    <div class="stat-box-change up">▲ Semua tugas</div>
                </div>
                <div class="stat-box stat-yellow">
                    <div class="stat-box-label">Rating</div>
                    <div class="stat-box-num"><?= $rating; ?></div>
                    <div class="stat-box-change">Penilaian masyarakat</div>
                </div>
                <div class="stat-box stat-blue">
                    <div class="stat-box-label">Rata-rata Waktu</div>
                    <div class="stat-box-num"><?= $rataWaktu; ?></div>
                    <div class="stat-box-change">Penyelesaian tugas</div>
                </div>
                <div class="stat-box stat-orange">
                    <div class="stat-box-label">Bulan Ini</div>
                    <div class="stat-box-num"><?= $bulanIni; ?></div>
                    <div class="stat-box-change">Tugas selesai</div>
                </div>
            </div>

            <div class="card mb-20">
                <div class="card-header">
                    <div>
                        <div class="card-title">Filter Riwayat</div>
                        <div class="card-subtitle">Cari tugas berdasarkan bulan atau kategori</div>
                    </div>
                </div>
                <div class="filter-row">
                    <select class="form-select">
                        <option>Semua Bulan</option>
                        <option>November 2024</option>
                        <option>Oktober 2024</option>
                        <option>September 2024</option>
                    </select>
                    <select class="form-select">
                        <option>Semua Kategori</option>
                        <option>Infrastruktur</option>
                        <option>Darurat</option>
                    </select>
                    <input type="text" class="form-input" placeholder="Cari laporan...">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-title">Daftar Tugas Selesai</div>
                        <div class="card-subtitle">Riwayat pekerjaan yang telah diselesaikan</div>
                    </div>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Rating</th>
                                <th>Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="id-badge">RPT-0821</span></td>
                                <td>Drainase Tersumbat</td>
                                <td>Jl. Sultan Agung</td>
                                <td><span class="cat-tag cat-infrastruktur">Infrastruktur</span></td>
                                <td><span class="pill pill-selesai">Selesai</span></td>
                                <td>⭐⭐⭐⭐⭐</td>
                                <td>10 Nov 2024</td>
                            </tr>
                            <tr>
                                <td><span class="id-badge">RPT-0815</span></td>
                                <td>Jalan Retak Dekat Sekolah</td>
                                <td>Jl. Imam Bonjol</td>
                                <td><span class="cat-tag cat-infrastruktur">Infrastruktur</span></td>
                                <td><span class="pill pill-selesai">Selesai</span></td>
                                <td>⭐⭐⭐⭐⭐</td>
                                <td>8 Nov 2024</td>
                            </tr>
                            <tr>
                                <td><span class="id-badge">RPT-0802</span></td>
                                <td>Gorong-gorong Tersumbat</td>
                                <td>Jl. Kartini</td>
                                <td><span class="cat-tag cat-darurat">Darurat</span></td>
                                <td><span class="pill pill-selesai">Selesai</span></td>
                                <td>⭐⭐⭐⭐</td>
                                <td>5 Nov 2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </main>

</div>

<script>
function confirmLogout() {
    const yakin = confirm("Yakin ingin keluar?");
    if (yakin) {
        window.location.href = "../logout.php";
    }
}
</script>

</body>
</html>