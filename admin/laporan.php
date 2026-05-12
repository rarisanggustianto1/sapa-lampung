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

    <title>Laporan Masuk — SAPA Admin</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">

        <div>

            <div class="sidebar-brand">

                <div class="sidebar-logo">
                    SA
                </div>

                <div>
                    <div class="sidebar-brand-name">SAPA Admin</div>
                    <div class="sidebar-brand-sub">Panel Administrator</div>
                </div>

            </div>

            <nav class="sidebar-nav">

                <a href="dashboard.php" class="sidebar-item">
                    Dashboard
                </a>

                <a href="laporan.php" class="sidebar-item active">
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
                    <?= strtoupper(substr($nama, 0, 1)) ?>
                </div>

                <div>
                    <div class="sidebar-user-name">
                        <?= htmlspecialchars($nama) ?>
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
                    Laporan Masuk
                </h1>

                <p class="page-subtitle">
                    Verifikasi dan tindak lanjuti laporan masyarakat
                </p>
            </div>

        </div>

        <div class="content-body">

            <div class="stats-row stats-row-3">

                <div class="stat-box">
                    <div class="stat-box-label">
                        Pending
                    </div>

                    <div class="stat-box-num">
                        12
                    </div>

                    <div class="stat-box-change">
                        Belum diverifikasi
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">
                        Diverifikasi
                    </div>

                    <div class="stat-box-num">
                        34
                    </div>

                    <div class="stat-box-change">
                        Menunggu penugasan
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">
                        Diproses
                    </div>

                    <div class="stat-box-num">
                        87
                    </div>

                    <div class="stat-box-change">
                        Sedang ditangani
                    </div>
                </div>

            </div>

            <div class="alert-box">
                <strong>Perhatian:</strong>
                Terdapat 12 laporan pending yang perlu segera diverifikasi.
            </div>

            <div class="card">

                <div class="card-header">

                    <div>
                        <div class="card-title">
                            Daftar Laporan
                        </div>

                        <div class="card-subtitle">
                            Data laporan masyarakat terbaru
                        </div>
                    </div>

                    <a href="#" class="btn-outline">
                        Export
                    </a>

                </div>

                <div class="filter-row">

                    <input
                        type="text"
                        class="form-input"
                        placeholder="Cari ID laporan atau petugas..."
                    >

                    <select>
                        <option>Semua Kategori</option>
                        <option>Infrastruktur</option>
                        <option>Kebersihan</option>
                        <option>Keamanan</option>
                        <option>Fasilitas Umum</option>
                    </select>

                    <select>
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Diverifikasi</option>
                        <option>Diproses</option>
                        <option>Selesai</option>
                    </select>

                </div>

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>
                                <th>ID</th>
                                <th>Pelapor</th>
                                <th>Judul Laporan</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
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
                                    Budi Santoso
                                </td>

                                <td>
                                    Tumpukan Sampah TPS
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
                                    13 Nov 2024
                                </td>

                                <td>
                                    <a href="#" class="table-btn">
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
                                    Dewi Lestari
                                </td>

                                <td>
                                    Jembatan Retak Membahayakan
                                </td>

                                <td>
                                    <span class="cat-tag cat-infrastruktur">
                                        Infrastruktur
                                    </span>
                                </td>

                                <td>
                                    <span class="pill pill-verifikasi">
                                        Diverifikasi
                                    </span>
                                </td>

                                <td>
                                    13 Nov 2024
                                </td>

                                <td>
                                    <a href="#" class="table-btn">
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
                                    Hendra Gunawan
                                </td>

                                <td>
                                    Gangguan Keamanan
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
                                    12 Nov 2024
                                </td>

                                <td>
                                    <a href="#" class="table-btn">
                                        Detail
                                    </a>
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <span class="id-badge">
                                        RPT-0821
                                    </span>
                                </td>

                                <td>
                                    Rina Marlina
                                </td>

                                <td>
                                    Lampu Jalan Mati
                                </td>

                                <td>
                                    <span class="cat-tag cat-fasilitas">
                                        Fasilitas
                                    </span>
                                </td>

                                <td>
                                    <span class="pill pill-selesai">
                                        Selesai
                                    </span>
                                </td>

                                <td>
                                    10 Nov 2024
                                </td>

                                <td>
                                    <a href="#" class="table-btn">
                                        Detail
                                    </a>
                                </td>

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

    const yakin = confirm("Yakin mau keluar dari akun?");

    if (yakin) {
        window.location.href = "../logout.php";
    }

}
</script>

</body>
</html>